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
 * @subpackage GraphQL\Server
 */

declare(strict_types=1);

namespace WPEForm\GraphQL\Server;

use WPEForm\GeneralDeps\GraphQL\Error\DebugFlag;
use WPEForm\GeneralDeps\GraphQL\Error\FormattedError;
use WPEForm\GeneralDeps\GraphQL\Error\InvariantViolation;
use WPEForm\GeneralDeps\GraphQL\Executor\ExecutionResult;
use WPEForm\GeneralDeps\GraphQL\Executor\Promise\Promise;
use WPEForm\GeneralDeps\GraphQL\Server\ServerConfig;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;

use Throwable;
use function is_array;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

// phpcs:ignoreFile

/**
 * An enhanced StandServer class for abiding apollo-client rules.
 *
 * @package WPEForm\GraphQL\Server
 */
class StandardServer {
	/** @var ServerConfig */
	private $config;

	/** @var Helper */
	private $helper;

	/**
	 * Converts and exception to error and sends spec-compliant HTTP 500 error.
	 * Useful when an exception is thrown somewhere outside of server execution context
	 * (e.g. during schema instantiation).
	 *
	 * @param Throwable $error
	 * @param int       $debug
	 * @param bool      $exitWhenDone
	 *
	 * @api
	 */
	public static function send500Error($error, $debug = DebugFlag::NONE, $exitWhenDone = false)
	{
		$response = [
			'errors' => [FormattedError::createFromException($error, $debug)],
		];
		$helper   = new Helper();
		$helper->emitResponse($response, 500, $exitWhenDone);
	}

	/**
	 * Creates new instance of a standard GraphQL HTTP server
	 *
	 * @param ServerConfig|mixed[] $config
	 *
	 * @api
	 */
	public function __construct($config)
	{
		if (is_array($config)) {
			$config = ServerConfig::create($config);
		}
		if (! $config instanceof ServerConfig) {
			throw new InvariantViolation('Expecting valid server config, but got ' . Utils::printSafe($config));
		}
		$this->config = $config;
		$this->helper = new Helper();
	}

	/**
	 * Parses HTTP request, executes and emits response (using standard PHP `header` function and `echo`)
	 *
	 * By default (when $parsedBody is not set) it uses PHP globals to parse a request.
	 * It is possible to implement request parsing elsewhere (e.g. using framework Request instance)
	 * and then pass it to the server.
	 *
	 * See `executeRequest()` if you prefer to emit response yourself
	 * (e.g. using Response object of some framework)
	 *
	 * @param OperationParams|OperationParams[] $parsedBody
	 * @param bool                              $exitWhenDone
	 *
	 * @api
	 */
	public function handleRequest($parsedBody = null, $exitWhenDone = false)
	{
		$result = $this->executeRequest($parsedBody);
		$this->helper->sendResponse($result, $exitWhenDone);
	}

	/**
	 * Executes GraphQL operation and returns execution result
	 * (or promise when promise adapter is different from SyncPromiseAdapter).
	 *
	 * By default (when $parsedBody is not set) it uses PHP globals to parse a request.
	 * It is possible to implement request parsing elsewhere (e.g. using framework Request instance)
	 * and then pass it to the server.
	 *
	 * PSR-7 compatible method executePsrRequest() does exactly this.
	 *
	 * @param OperationParams|OperationParams[] $parsedBody
	 *
	 * @return ExecutionResult|ExecutionResult[]|Promise
	 *
	 * @throws InvariantViolation
	 *
	 * @api
	 */
	public function executeRequest($parsedBody = null)
	{
		if ($parsedBody === null) {
			$parsedBody = $this->helper->parseHttpRequest();
		}

		if (is_array($parsedBody)) {
			return $this->helper->executeBatch($this->config, $parsedBody);
		}

		return $this->helper->executeOperation($this->config, $parsedBody);
	}
}
