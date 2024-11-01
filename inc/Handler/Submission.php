<?php

/**
 * Copyright (C) 2018 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of eForm - WordPress Builder.
 *
 * eForm - WordPress Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * eForm - WordPress Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with eForm - WordPress Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package EForm
 * @subpackage Handler
 */
namespace WPEForm\Handler;

use  WPEForm\Auth\IAuth ;
use  WPEForm\Model\Form ;
use  WPEForm\Exception\ResourceDoesNotExistException ;
use  LogicException ;
use  WPEForm\Model\Submission as SubmissionModel ;
use  WPEForm\Auth\Submission as SubmissionAuth ;
use  WPEForm\System\SystemEndpoint ;
use  Exception ;
use  WPEForm\CoR\Submission\PermissionsPresaveMutationsRunner ;
use  WPEForm\CoR\Submission\SettingsMutationsRunner ;
use  WPEForm\States\Submission\Clock ;
use  WPEForm\States\Submission\Conditionals ;
use  WPEForm\States\Submission\Elements ;
use  WPEForm\States\Submission\Html ;
use  WPEForm\States\Submission\Pdf ;
use  WPEForm\States\Submission\Mailer ;
use  WPEForm\States\Submission\Primitives ;
use  WPEForm\States\Submission\Score ;
use  WPEForm\States\Submission\Slate ;
use  WPEForm\System\Init ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * A class to handle all elements, integrations and payments of a submission.
 * Internally it calls proper controller and model to handle form data.
 */
class Submission
{
    /**
     * Form model for the submission handler.
     *
     * @var Form
     */
    protected  $form_model = null ;
    /**
     * Submission model. This is set when called using get_instance_from_model.
     *
     * @var SubmissionModel | null
     */
    protected  $submission_model = null ;
    /**
     * Auth for Submission handler.
     *
     * @var IAuth
     */
    protected  $auth = null ;
    /**
     * Token for the submission. This must be set by the controller.
     *
     * @var string
     */
    protected  $token = null ;
    /**
     * ID for the submission. This must be set by the controller.
     *
     * @var string
     */
    protected  $submission_id = null ;
    /**
     * Referer value.
     *
     * @var string|null
     */
    protected  $referer = null ;
    /**
     * Whether or not can user edit this submission (for existing submissions only).
     *
     * @var bool
     */
    protected  $can_user_edit = false ;
    /**
     * Administrator remarks.
     *
     * @var string
     */
    protected  $admin_remarks = '' ;
    /**
     * Payment status flag of the submission.
     *
     * 0 - Unpaid.
     * 1 - Paid.
     * 2 - Not needed.
     *
     * @var int
     */
    protected  $paid = 2 ;
    /**
     * @var bool
     */
    protected  $is_update ;
    /**
     * @var bool
     */
    protected  $is_admin_update ;
    /**
     * @var Mailer
     */
    protected  $mailer ;
    /**
     * @var Pdf
     */
    protected  $pdf ;
    /**
     * @var Slate
     */
    protected  $slate ;
    /**
     * @var Html
     */
    protected  $html ;
    /**
     * @var Score
     */
    protected  $score ;
    /**
     * @var Primitives
     */
    protected  $primitives ;
    /**
     * @var Elements
     */
    protected  $elements ;
    /**
     * @var Conditionals
     */
    private  $conditionals ;
    /**
     * @var Clock
     */
    private  $clock ;
    // #region Static Instantiator
    /**
     * Get submission handler instance from submission model, auth model and update type.
     *
     * @param SubmissionModel $model Submission model, where id/token is already set.
     * @param SubmissionAuth  $auth Submission Auth instance.
     * @param bool            $is_update Whether or not this is an update.
     * @param bool            $is_admin_update Whether or not this admin update.
     * @param Form            $form_model A form model instance with data set. If not provided, one will be created.
     * @return null|Submission Handler instance on success, null on failure.
     */
    public static function get_instance_from_models(
        SubmissionModel $model,
        SubmissionAuth $auth,
        bool $is_update,
        bool $is_admin_update,
        ?Form $form_model = null
    ) : ?Submission
    {
        try {
            // bail early if submission model doesn't exist
            if ( !$model->exists() ) {
                return null;
            }
            // get data coz we need the formId from the submission model
            $submission_data = $model->read();
            $handler = new Submission(
                (int) $submission_data['formId'],
                $submission_data['elements'],
                true,
                $auth,
                $form_model,
                $is_update,
                $is_admin_update
            );
            // set the token and other values
            $handler->set_token( $submission_data['token'] );
            $handler->set_referer( $submission_data['referer'] ?? '' );
            $handler->clock()->set_date( $submission_data['created'] ?? '0000-00-00 00:00:00' );
            $handler->set_submission_id( (string) $model->get_id() );
            $handler->clock()->set_time( $submission_data['time'] ?? 0 );
            $handler->set_admin_remarks( $submission_data['adminRemarks'] );
            $handler->set_submission_model( $model );
            $paid = \intval( $submission_data['paid'] );
            $handler->set_paid( ( \in_array( $paid, [ 0, 1, 2 ] ) ? $paid : 0 ) );
            
            if ( !\is_null( $submission_data['maxScore'] ) ) {
                $handler->score()->set_score_from_db(
                    true,
                    \floatval( $submission_data['score'] ),
                    \floatval( $submission_data['maxScore'] ),
                    $submission_data['scoreData'] ?? []
                );
            } else {
                $handler->score()->set_score_from_db(
                    false,
                    0,
                    0,
                    []
                );
            }
            
            // run the mutations because we need the configurations and primitives
            // of the submission handler set.
            $mutation_processor = new SettingsMutationsRunner();
            $mutation_processor->link_with( new PermissionsPresaveMutationsRunner() );
            $mutation_processor->process( $handler );
            // $handler->run_settings_mutations( $is_update, $is_admin_update );
            // $handler->run_permissions_presave_mutations( $is_update );
            return $handler;
            // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
        } catch ( Exception $e ) {
            // do nothing
        }
        return null;
    }
    
    /**
     * Get a Submission handler instance from token. It would return null if
     * token is invalid.
     *
     * @param string $token The token.
     * @param bool   $is_update Whether or not this handler is intended for update.
     * @param bool   $admin_update Whether or not the update is from admin.
     *
     * @return null|Submission Submission instance, or null if token is invalid.
     */
    public static function get_instance_from_token( string $token, bool $is_update, bool $admin_update ) : ?Submission
    {
        try {
            $model = new SubmissionModel();
            $auth = new SubmissionAuth();
            // set the token in the model
            $model->set_id( null, $token );
            return self::get_instance_from_models(
                $model,
                $auth,
                $is_update,
                $admin_update
            );
            // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
        } catch ( Exception $e ) {
            // do nothing, because the token is wrong, so just continue and
            // return null
        }
        return null;
    }
    
    /**
     * Get a Submission handler instance from token. It would return null if
     * token is invalid.
     *
     * @param string $id The token.
     * @param bool   $is_update Whether or not this handler is intended for update.
     * @param bool   $admin_update Whether or not the update is from admin.
     *
     * @return null|Submission Submission instance, or null if token is invalid.
     */
    public static function get_instance_from_id( string $id, bool $is_update, bool $admin_update ) : ?Submission
    {
        try {
            $model = new SubmissionModel();
            $auth = new SubmissionAuth();
            // set the token in the model
            $model->set_id( $id );
            return self::get_instance_from_models(
                $model,
                $auth,
                $is_update,
                $admin_update
            );
            // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
        } catch ( Exception $e ) {
            // do nothing, because the token is wrong, so just continue and
            // return null
        }
        return null;
    }
    
    // #endregion
    /**
     * Create an instance.
     *
     * @throws ResourceDoesNotExistException If the form does not exist.
     *
     * @param int   $form_id       Id of the Form.
     * @param array $elements_data Submission element data as found from user input
     *                             or database.
     * @param bool  $processed     Whether the element data is processed or not.
     * @param IAuth $auth          Auth instance.
     * @param Form  $form_model    Form Model instance, if not provided one will be created.
     * @param bool  $isUpdate      (Optional, Default `false`) Whether in update context.
     * @param bool  $isAdminUpdate (Optional, Default `false`) Whether update is being done by an admin.
     */
    public function __construct(
        int $form_id,
        array $elements_data,
        bool $processed,
        IAuth $auth,
        ?Form $form_model = null,
        bool $isUpdate = false,
        bool $isAdminUpdate = false
    )
    {
        
        if ( !$form_model ) {
            $form_model = new Form();
            $form_model->set_id( $form_id );
        }
        
        if ( !$form_model->exists() ) {
            throw new ResourceDoesNotExistException( 'The form for the submission does not exist.' );
        }
        $this->form_model = $form_model;
        $this->auth = $auth;
        $this->is_update = $isUpdate;
        $this->is_admin_update = $isAdminUpdate;
        // Expose States.
        $this->elements = new Elements( $this, $elements_data, $processed );
        $this->conditionals = new Conditionals( $this );
        $this->slate = new Slate( $this );
        $this->mailer = new Mailer( $this );
        $this->pdf = new Pdf( $this );
        $this->html = new Html( $this );
        $this->score = new Score( $this );
        $this->primitives = new Primitives( $this );
        $this->clock = new Clock( $this );
    }
    
    // #region States.
    /**
     * Get the mailer builder, associated with this submission.
     *
     * @return Mailer
     */
    public function mailer() : Mailer
    {
        return $this->mailer;
    }
    
    /**
     * Get the pdf builder, associated with this submission.
     *
     * @return Pdf
     */
    public function pdf() : Pdf
    {
        return $this->pdf;
    }
    
    /**
     * Get the slatejs builder, associated with this submission.
     *
     * @return Slate
     */
    public function slate() : Slate
    {
        return $this->slate;
    }
    
    /**
     * Get the html builder, associated with this submission.
     *
     * @return Html
     */
    public function html() : Html
    {
        return $this->html;
    }
    
    /**
     * Get the score state builder, associated with this submission.
     *
     * @return Score
     */
    public function score() : Score
    {
        return $this->score;
    }
    
    /**
     * Get the primitive state builder, associated with this submission.
     *
     * @return Primitives
     */
    public function primitives() : Primitives
    {
        return $this->primitives;
    }
    
    /**
     * Get the elements state associated with this submission.
     *
     * @return Elements
     */
    public function elements() : Elements
    {
        return $this->elements;
    }
    
    /**
     * Get the conditionals state associated with this submission.
     *
     * @return Conditionals
     */
    public function conditionals() : Conditionals
    {
        return $this->conditionals;
    }
    
    /**
     * Get the clock state associated with this submission.
     *
     * @return Clock
     */
    public function clock() : Clock
    {
        return $this->clock;
    }
    
    // #endregion
    // #region Getter Setters
    /**
     * Set admin remarks.
     *
     * @param string $remarks Remarks as written by admin.
     * @return void
     */
    public function set_admin_remarks( string $remarks ) : void
    {
        $this->admin_remarks = $remarks;
    }
    
    /**
     * Get admin remarks. Could be an empty string.
     *
     * @return string
     */
    public function get_admin_remarks() : string
    {
        return $this->admin_remarks;
    }
    
    /**
     * Set whether or not can user edit.
     *
     * @param bool $can Flag to determine whether can user edit this submission.
     * @return void
     */
    public function set_can_user_edit( bool $can ) : void
    {
        $this->can_user_edit = $can;
    }
    
    /**
     * Get whether can user edit this submission or not.
     *
     * @return bool
     */
    public function get_can_user_edit() : bool
    {
        return $this->can_user_edit;
    }
    
    /**
     * Get the referer.
     *
     * @throws LogicException If referer has not already been set.
     *
     * @return string
     */
    public function get_referer() : string
    {
        if ( !$this->referer ) {
            throw new LogicException( 'Referer is not set.' );
        }
        return $this->referer;
    }
    
    /**
     * Set the referer.
     *
     * @throws LogicException If the referer is already set.
     *
     * @param string $referer The referer.
     *
     * @return void
     */
    public function set_referer( string $referer )
    {
        if ( $this->referer ) {
            throw new LogicException( 'Referer is already set.' );
        }
        $this->referer = $referer;
    }
    
    /**
     * Get the token.
     *
     * @throws LogicException If token has not already been set.
     *
     * @return string
     */
    public function get_token() : string
    {
        if ( !$this->token ) {
            throw new LogicException( 'Token is not set.' );
        }
        return $this->token;
    }
    
    /**
     * Set the token.
     *
     * @throws LogicException If the token is already set.
     *
     * @param string $token The token.
     *
     * @return void
     */
    public function set_token( string $token )
    {
        if ( $this->token ) {
            throw new LogicException( 'Token is already set.' );
        }
        $this->token = $token;
    }
    
    /**
     * Get the submission_id.
     *
     * @throws LogicException If submission_id has not already been set.
     *
     * @return string
     */
    public function get_submission_id() : string
    {
        if ( !$this->submission_id ) {
            throw new LogicException( 'submission_id is not set.' );
        }
        return $this->submission_id;
    }
    
    /**
     * Set the submission_id.
     *
     * @throws LogicException If the submission_id is already set.
     *
     * @param string $submission_id The submission_id.
     *
     * @return void
     */
    public function set_submission_id( string $submission_id )
    {
        if ( $this->submission_id ) {
            throw new LogicException( 'submission_id is already set.' );
        }
        $this->submission_id = $submission_id;
    }
    
    /**
     * Get Submission Model from the handler.
     *
     * @throws LogicException If for some reason the model is null.
     *
     * @return  SubmissionModel Submission Model.
     */
    public function get_submission_model() : SubmissionModel
    {
        if ( $this->submission_model === null ) {
            throw new LogicException( 'Submission model is not present in submission handler.' );
        }
        return $this->submission_model;
    }
    
    /**
     * Set Submission Model from the handler.
     *
     * @param SubmissionModel $submission The submission model.
     *
     * @return  void.
     */
    public function set_submission_model( SubmissionModel $submission ) : void
    {
        $this->submission_model = $submission;
    }
    
    // #endregion
    // #region Readonly Getters
    /**
     * Get submission link of the submission.
     *
     * @return string Link of the submission.
     * @throws LogicException If token is not set.
     */
    public function get_submission_link() : string
    {
        return SystemEndpoint::get_summary_page_link( $this->get_token() );
    }
    
    /**
     * Get submission download link of the submission.
     *
     * @param bool $as_admin Whether the download link should be for admin.
     * @return string Link of the submission pdf.
     * @throws LogicException If token is not set.
     */
    public function get_submission_download_link( bool $as_admin ) : ?string
    {
        // ENDFS: this if block will be removed
        return null;
    }
    
    /**
     * Get submission print page link of the submission.
     *
     * @param bool $as_admin Whether the download link should be for admin.
     * @return string Link of the submission HTML.
     * @throws LogicException If token is not set.
     */
    public function get_submission_print_link( bool $as_admin ) : string
    {
        return SystemEndpoint::get_summary_print_page_link( ( $as_admin ? $this->get_submission_id() : $this->get_token() ), $as_admin );
    }
    
    /**
     * Get Auth Instance.
     *
     * @return IAuth
     */
    public function get_auth() : IAuth
    {
        return $this->auth;
    }
    
    /**
     * Get form data as stored in the database.
     *
     * @return array|null
     */
    public function get_form_data() : ?array
    {
        if ( $this->form_model !== null ) {
            return $this->form_model->read();
        }
        return null;
    }
    
    /**
     * Get Form Model from the handler.
     *
     * @throws LogicException If for some reason the model is null.
     *
     * @return Form The Form Model.
     */
    public function get_form_model() : Form
    {
        if ( $this->form_model === null ) {
            throw new LogicException( 'Form model is not present in submission handler.' );
        }
        return $this->form_model;
    }
    
    // #endregion
    // #region Data Modelling
    /**
     * Append data to Submission model to complete the Submission Type on GraphQL.
     *
     * @param array $data Original data as received from Submission model.
     * @param bool  $is_update Whether or not this is an update.
     *
     * @return array
     */
    public function append_data_to_model( array $data, bool $is_update ) : array
    {
        // TODO: Append some additional data needed during create and update operation
        // NOTE: Basically needed for payment related stuff.
        $data['paid'] = $this->get_paid_for_graphql();
        return $data;
    }
    
    // #endregion
    // #region Payment (TODO: Refactor out)
    /**
     * Get paid status for GraphQL.
     *
     * @return null|bool
     */
    public function get_paid_for_graphql() : ?bool
    {
        if ( $this->paid === 2 ) {
            return null;
        }
        if ( $this->paid === 1 ) {
            return true;
        }
        return false;
    }
    
    /**
     * Set paid status in the handler.
     *
     * @throws LogicException If invalid $status is passed.
     *
     * @param int $status Payment status, one of 0, 1 or 2.
     *
     * @return void
     */
    public function set_paid( int $status ) : void
    {
        if ( !\in_array( $status, [ 0, 1, 2 ], true ) ) {
            throw new LogicException( 'Payment status could be one of 0, 1 and 2.' );
        }
        $this->paid = $status;
    }
    
    /**
     * Get paid status of the handler.
     *
     * ```
     * 0 - Unpaid.
     * 1 - Paid.
     * 2 - Not needed.
     * ```
     *
     * @return int
     */
    public function get_paid() : int
    {
        return $this->paid;
    }
    
    /**
     * Process payment intent and return data from the Payments class.
     * Call this when saving the form data and about to show the UI to the user.
     *
     * @throws LogicException If data hasn't been processed yet.
     *
     * @return mixed
     */
    public function process_payment_intent()
    {
        $payment_handler = new Payment( $this->form_model, $this );
        // if payment is not needed, then just bail
        if ( !$payment_handler->is_payment_needed() ) {
            return;
        }
        // Create the initial record
        $payment_handler->initialize_record();
        // 3. Loop through all payments and
        // 3a. Check if payment is a gateway and that is active in `general`.
        // 3b. Call the first process method and insert it to the response.
    }
    
    /**
     * Finalize payemnt from the data received from Payments UI shown after
     * the intent was initiated. It calls Payment class with user input and
     * returns from the method.
     *
     * @throws LogicException If data hasn't been processed yet.
     *
     * @return mixed
     */
    public function finalize_payment()
    {
        $this->elements()->throw_if_elements_not_processed();
    }
    
    // #endregion
    // #region Assertions
    /**
     * Whether in update context.
     *
     * @return bool
     */
    public function is_update() : bool
    {
        return $this->is_update;
    }
    
    /**
     * Whether is admin update context
     *
     * @return bool
     */
    public function is_admin_update() : bool
    {
        return $this->is_admin_update;
    }
    
    /**
     * Check if token has been set or not.
     *
     * @return bool
     */
    public function has_token() : bool
    {
        if ( $this->token ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if submission_id has been set or not.
     *
     * @return bool
     */
    public function has_submission_id() : bool
    {
        if ( $this->submission_id ) {
            return true;
        }
        return false;
    }

}