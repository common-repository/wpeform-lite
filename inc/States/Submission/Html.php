<?php

/**
 * Copyright (C) 2022 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of WPEForm - WordPress Form Builder.
 *
 * WPEForm - WordPress Form Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WPEForm - WordPress Form Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPEForm - WordPress Form Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WPEForm
 * @subpackage States\Submission
 */
namespace WPEForm\States\Submission;

use  WPEForm\Factory\Form\Elements ;
use  WPEForm\System\Init ;
use  WPEForm\Util\HTMLChart ;
use  WPEForm\Util\SlateJS ;
// @codeCoverageIgnoreStart
if ( !defined( 'ABSPATH' ) ) {
    die( '' );
}
// @codeCoverageIgnoreEnd
/**
 * HTML related builders for the submission handler.
 *
 * @package WPEForm\States\Submission
 */
class Html extends Base
{
    const  PURPOSE_EMAIL = 'email' ;
    const  PURPOSE_PDF = 'pdf' ;
    /**
     * Get Submission Preview HTML.
     *
     * @param string $purpose Purpose of the HTML. One of `HtmlBuilder::PURPOSE_*`.
     *
     * @return string The HTML.
     */
    public function get_submission_preview_html( string $purpose = self::PURPOSE_EMAIL ) : string
    {
        $submission_handler = $this->submission_handler;
        $score_designation_mentions = $submission_handler->score()->get_score_and_designation_mentions();
        $score_metadata = $submission_handler->score()->get_primaryscore_metadata();
        $elements_config_dictionary = $submission_handler->elements()->get_elements_config_dictionary();
        $processed_elements_dictionary = $submission_handler->elements()->get_processed_elements_dictionary();
        $output = '';
        // ENDFS: this if block will be removed
        $structures = $submission_handler->elements()->get_active_structures();
        foreach ( $structures as $structure ) {
            $elements = $submission_handler->elements()->get_active_submission_elements_per_structure( $structure['id'] );
            // If elements are empty, then continue
            if ( empty($elements) ) {
                continue;
            }
            $output .= '<h2 class="page-title">' . SlateJS::parseEditorChildrenJSON( $structure['config']['title'] )->setRenderMentions( $submission_handler->slate()->get_slatejs_mentions_callback() )->getText( 'singleline' ) . '</h2>';
            foreach ( $elements as $element_id ) {
                $element_config = $elements_config_dictionary[$element_id] ?? null;
                $element_submission = $processed_elements_dictionary[$element_id] ?? null;
                if ( !$element_config || !$element_submission ) {
                    continue;
                }
                $element_type = $element_config['type'];
                if ( !Elements::has_element( $element_type ) ) {
                    continue;
                }
                $element_instance = Elements::get_element_instance( $element_type );
                $element_output = $element_instance->get_html_value(
                    $element_config['appearance'],
                    $element_config['config'][$element_type],
                    $element_submission['value'][$element_type],
                    $submission_handler->slate()->get_slatejs_mentions_callback(),
                    $purpose
                );
                
                if ( !empty($element_output) ) {
                    $output .= $element_output;
                    // also add score if present
                    
                    if ( isset( $element_submission['scores'] ) && !empty($element_submission['scores']) && $score_metadata !== null ) {
                        $output .= '<table class="scores" width="100%" cellpadding="0" cellspacing="0" role="presentation">';
                        foreach ( $element_submission['scores'] as $elem_score ) {
                            
                            if ( $elem_score['has'] && $elem_score['outof'] !== 0 ) {
                                $sid = $elem_score['scoreId'];
                                $output .= '<tr><td class="scores__cell scores__cell--heading">' . ($score_designation_mentions["::score-name-{$sid}::"] ?? \__( 'Score', 'wp-eform' )) . '</td><td class="scores__cell scores__cell--value">' . \call_user_func( $score_metadata['formatter'], $elem_score['obtained'] ) . '</td><td class="scores__cell scores__cell--value">' . \call_user_func( $score_metadata['formatter'], $elem_score['outof'] ) . '</td><td class="scores__cell scores__cell--value">' . \call_user_func( $score_metadata['formatter'], $elem_score['obtained'] / $elem_score['outof'] * 100 ) . '%' . '</td></tr>';
                                if ( $score_designation_mentions["::score-description-{$sid}::"] ) {
                                    $output .= '<tr><td colspan="4" class="scores__cell">' . $score_designation_mentions["::score-description-{$sid}::"] . '</td></tr>';
                                }
                            }
                        
                        }
                        $output .= '</table>';
                    }
                    
                    $output .= '<hr class="divider" />';
                }
            
            }
        }
        return $output;
    }

}