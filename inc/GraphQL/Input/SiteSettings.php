<?php
/**
 * Copyright (C) 2021 Swashata Ghosh <swashata@wpquark.com>
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
 * @package EForm
 * @subpackage GraphQL\Input
 */

namespace WPEForm\GraphQL\Input;

use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GraphQL\Field\SiteSettings as SiteSettingsField;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for SiteSettingsInput.
 *
 * @package WPEForm\GraphQL\Input
 */
class SiteSettings extends InputObjectType {
	/**
	 * Create an instance.
	 */
	public function __construct() {
		$fields = SiteSettingsField::get_input_fields();
		$fields['userPortalSkeleton'] = Type::string();
		$fields['summaryGeneralSSR'] = Type::string();
		$config = [
			'name' => 'SiteSettingsInput',
			'fields' => $fields,
		];
		parent::__construct( $config );
	}
}
