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
 * @subpackage Form\Config\Settings
 */

namespace WPEForm\Form\Config\Settings;

use WPEForm\States\Submission\Primitives;
use WPEForm\Exception\InvalidElementException;
use WPEForm\GraphQL\Util\FieldVar;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\Model\IModel;
use WPEForm\Handler\Submission as SubmissionHandler;
use function WPEForm\Helpers\get_element_from_array_by_id;
use WPEForm\Factory\Form\Elements;
use WPEForm\GeneralDeps\geertw\IpAnonymizer\IpAnonymizer;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Settings class for UserData.
 */
class UserData extends Base {
	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_side_effect( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		// no side effect
	}

	/**
	 * Get primitive value for an element.
	 *
	 * @param string            $element_id Id of the element.
	 * @param array             $submission_elements All submission elements.
	 * @param array             $form_elements All form elements.
	 * @param SubmissionHandler $handler Submission handler instance.
	 *
	 * @return null|string String value if found, null otherwise.
	 */
	protected function get_primitive_value( string $element_id, array $submission_elements, array $form_elements, SubmissionHandler $handler ): ?string {
		$submission_element = get_element_from_array_by_id(
			$submission_elements,
			$element_id
		);
		if ( $submission_element === null ) {
			return null;
		}

		$form_element = get_element_from_array_by_id(
			$form_elements,
			$element_id
		);
		if ( $form_element === null ) {
			return null;
		}

		$element_type = $form_element['type'];

		if ( Elements::has_element( $element_type ) ) {
			$element_instance = Elements::get_element_instance( $element_type );
			$value = $element_instance->get_simple_value(
				$form_element['config'][ $element_type ],
				$submission_element['value'][ $element_type ] ?? $element_instance->get_default_data_value(),
				[
					'type' => 'label',
					'return' => 'string',
				],
				$handler->slate()->get_slatejs_mentions_callback()
			);
			if ( \is_string( $value ) ) {
				return $value;
			}
		}

		return null;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param SubmissionHandler $submission_handler Submission handler instance.
	 * @param array             $config             Configuration for this settings.
	 * @param bool              $is_update          Whether or not this is a submission update.
	 * @param bool              $admin_update       Whether or not this is an admin update.
	 *
	 * @return void
	 */
	public function run_mutation( SubmissionHandler $submission_handler, array $config, bool $is_update, bool $admin_update ): void {
		$form_data = $submission_handler->get_form_data();
		$submission_elements = $submission_handler->elements()->get_processed_elements();

		// set which of the primitives to be calculated separately
		$primitives_from_elements = [ Primitives::TYPE_EMAIL, Primitives::TYPE_PHONE ];

		// set fName and lName
		$f_name = $config['fName'];
		$l_name = $config['lName'];

		// If both are the same, then split and process.
		if ( $f_name === $l_name && $f_name !== null && $l_name !== null ) {
			$name_value = $this->get_primitive_value(
				$f_name,
				$submission_elements,
				$form_data['elements'],
				$submission_handler
			);

			// now split and set primitive
			if ( \is_string( $name_value ) ) {
				$name_parts = \explode( ' ', $name_value );
				$first_name = \array_shift( $name_parts );
				$submission_handler
					->primitives()
					->set_primitive( Primitives::TYPE_FNAME, $first_name );

				if ( \count( $name_parts ) ) {
					$submission_handler->primitives()->set_primitive(
						Primitives::TYPE_LNAME,
						\implode( ' ', $name_parts )
					);
				}
			}
		} else {
			// separately calculate fName and lName
			\array_push(
				$primitives_from_elements,
				Primitives::TYPE_FNAME,
				Primitives::TYPE_LNAME
			);
		}

		// set the primitives
		foreach ( $primitives_from_elements as $primitive ) {
			// if user has added an element and it is not null
			if ( $config[ $primitive ] !== null ) {
				$simple_value = $this->get_primitive_value(
					$config[ $primitive ],
					$submission_elements,
					$form_data['elements'],
					$submission_handler
				);

				if ( \is_string( $simple_value ) ) {
					$submission_handler->primitives()->set_primitive( $primitive, $simple_value );
				}
			}
		}

		// Set the ip if config says so
		if ( $config['storeIp'] === true ) {
			$ip_address = $_SERVER['REMOTE_ADDR'];
			if ( $config['anonymizeIp'] === true ) {
				// anonymize Ip address
				$anonimizer = new IpAnonymizer();
				$ip_address = $anonimizer->anonymize( $ip_address );
			}
			// set the primitive
			$submission_handler
				->primitives()
				->set_primitive( Primitives::TYPE_IP, $ip_address );
		}

		$auth = $submission_handler->get_auth();
		// set the user id if config says so
		if ( $config['storeUserId'] === true ) {
			$user_id = $auth->is_user_logged_in()
				? $auth->get_current_user_id()
				: null;
			$submission_handler
				->primitives()
				->set_primitive( Primitives::TYPE_USERID, $user_id );
		}
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return  array
	 */
	protected function config_vars(): array {
		$config_vars = [
			'fName' => FieldVar::var( null, Type::id() )
				->setNullable( true ),
			'lName' => FieldVar::var( null, Type::id() )
				->setNullable( true ),
			'email' => FieldVar::var( null, Type::id() )
				->setNullable( true ),
			'phone' => FieldVar::var( null, Type::id() )
				->setNullable( true ),
			'storeIp' => FieldVar::var( true, Type::boolean() ),
			'anonymizeIp' => FieldVar::var( false, Type::boolean() ),
			'storeUserId' => FieldVar::var( true, Type::boolean() ),
		];
		return $config_vars;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return bool
	 */
	public function is_user_facing() : bool {
		return false;
	}
}
