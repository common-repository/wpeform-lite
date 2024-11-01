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
 * @subpackage Form\Config\Integrations
 */

namespace WPEForm\Form\Config\Integrations;

use WPEForm\Form\Config\Base as ConfigBase;
use WPEForm\Handler\Submission as SubmissionHandler;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Abstract class for all integrations.
 *
 * This extends from the Config Base but also implements IIntegrations
 * making do_integration required for all child classes and providing an
 * easy way to write things, instead of writing implements IIntegrations for
 * every child classes.
 */
abstract class Base extends ConfigBase implements IIntegrations {
	/**
	 * Get custom data based on generic `IntegrationCustomData` config variable.
	 *
	 * @param array             $config A list of `IntegrationCustomData`.
	 * @param SubmissionHandler $handler The submission handler.
	 * @return array Key value pair as retrieved from Submission Handler.
	 */
	protected function get_customdata( array $config, SubmissionHandler $handler ) : array {
		$data = [];

		foreach ( $config as $tag ) {
			$data[ $tag['tagName'] ] = $handler->elements()->get_element_simple_value(
				$tag['elementId']
			);
		}

		return $data;
	}
}
