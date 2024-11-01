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
 * @subpackage GraphQL\Resolver
 */

namespace WPEForm\GraphQL\Resolver;

use WPEForm\Exception\InsufficientPermissionException;
use WPEForm\GraphQL\Registry;
use WPEForm\System\SystemEndpoint;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;

use function __;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * Class for all resolvers related to WP Users.
 */
class User implements IResolver {

	/**
	 * {@inheritDoc}
	 *
	 * @throws \LogicException If called.
	 * @return void
	 */
	public static function get_controller() {
		throw new \LogicException( 'User resolver does not depend on controllers' );
	}

	/**
	 * Get all query fields for users root query
	 *
	 * @return array
	 */
	public static function get_query_fields() {
		return [
			'wpFormManagers' => [
				'type' => Type::nonNull(
					Type::listOf(
						Type::nonNull( Registry::get( 'user', 'type' ) )
					)
				),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					// First check for permissions
					if ( ! \current_user_can( \WPEForm\Auth\Form::MANAGE ) ) {
						throw new InsufficientPermissionException( 'Current user does not have permission.' );
					}

					/** @var \WPDB $wpdb */
					global $wpdb;
					// For info about implementation, see this
					// https://stackoverflow.com/a/35347895/2754557
					$query_args = [
						'role__in' => [ 'administrator', 'editor' ],
						'number' => -1, // to select all users
					];

					$users_query = new \WP_User_Query( $query_args );
					$users = $users_query->get_results();

					if ( ! $users ) {
						return [];
					}
					$all_users = [];
					foreach ( $users as $user ) {
						/** @var \WP_User $user */
						$udata = [
							'id' => $user->ID,
							'username' => $user->user_nicename,
							'firstName' => null,
							'lastName' => null,
							'email' => null,
						];
						$all_users[] = $udata;
					}

					return $all_users;
				},
			],
			'me' => [
				'type' => Type::nonNull( Registry::get( 'me', 'type' ) ),
				'resolve' => function( $root, $args, $context, ResolveInfo $info ) {
					if ( ! \is_user_logged_in() ) {
						throw new InsufficientPermissionException( 'You have to be logged in.' );
					}
					$user_id = \get_current_user_id();
					$user_info = self::get_user_by_id( $user_id );
					$portal_info = \WPEForm\Model\Submission::get_user_portal_data( $user_id );
					$return = \array_merge( $user_info, $portal_info );
					$return['logoutLink'] = SystemEndpoint::get_logout_link();
					$return['avatarUrl'] = \get_avatar_url( $user_id, [ 'size' => 256 ] );
					return $return;
				},
			],
		];
	}

	/**
	 * {@inheritDoc}
	 *
	 * @return array
	 */
	public static function get_mutation_fields() {
		return [];
	}

	/**
	 * Get GraphQL compatible user type data by User Id.
	 *
	 * This doesn't check for any permission, so make sure to use it under
	 * sub types.
	 *
	 * @param int $id Id of WordPress user.
	 * @return array
	 */
	public static function get_user_by_id( $id ) {
		$user = \get_userdata( $id );
		if ( false === $user ) {
			return [
				'id' => $id,
				'username' => __( '(deleted)', 'wp-eform' ),
				'email' => '',
			];
		}
		$user_data = [
			'id' => $user->ID,
			'username' => $user->user_nicename,
			'firstName' => $user->first_name,
			'lastName' => $user->last_name,
			'email' => $user->user_email,
		];
		return $user_data;
	}
}
