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
use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Error\FormattedError;
use WPEForm\GeneralDeps\GraphQL\Error\InvariantViolation;
use WPEForm\GeneralDeps\GraphQL\Executor\ExecutionResult;
use WPEForm\GeneralDeps\GraphQL\Executor\Executor;
use WPEForm\GeneralDeps\GraphQL\Executor\Promise\Adapter\SyncPromiseAdapter;
use WPEForm\GeneralDeps\GraphQL\Executor\Promise\Promise;
use WPEForm\GeneralDeps\GraphQL\Executor\Promise\PromiseAdapter;
use WPEForm\GeneralDeps\GraphQL\GraphQL;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DocumentNode;
use WPEForm\GeneralDeps\GraphQL\Language\Parser;
use WPEForm\GeneralDeps\GraphQL\Server\OperationParams;
use WPEForm\GeneralDeps\GraphQL\Server\RequestError;
use WPEForm\GeneralDeps\GraphQL\Server\ServerConfig;
use WPEForm\GeneralDeps\GraphQL\Utils\AST;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use JsonSerializable;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

// phpcs:ignoreFile

/**
 * A Helper class for performing GraphQL Server requests.
 *
 * Modified version of the one found in webonyx/graphql-php.
 *
 * @package WPEForm\GraphQL\Server
 */
class Helper {
	/**
	 * Parses HTTP request using PHP globals and returns GraphQL OperationParams
	 * contained in this request. For batched requests it returns an array of OperationParams.
	 *
	 * This function does not check validity of these params
	 * (validation is performed separately in validateOperationParams() method).
	 *
	 * If $readRawBodyFn argument is not provided - will attempt to read raw request body
	 * from `php://input` stream.
	 *
	 * Internally it normalizes input to $method, $bodyParams and $queryParams and
	 * calls `parseRequestParams()` to produce actual return value.
	 *
	 * For PSR-7 request parsing use `parsePsrRequest()` instead.
	 *
	 * @return OperationParams|OperationParams[]
	 *
	 * @throws RequestError
	 *
	 * @api
	 */
	public function parseHttpRequest(?callable $readRawBodyFn = null)
	{
		$method     = $_SERVER['REQUEST_METHOD'] ?? null;
		$bodyParams = [];
		$urlParams  = ! empty( $_GET ) ? \wp_unslash( $_GET ) : [];

		if ($method === 'POST') {
			$contentType = $_SERVER['CONTENT_TYPE'] ?? null;

			if ($contentType === null) {
				throw new RequestError('Missing "Content-Type" header');
			}

			if (stripos($contentType, 'application/graphql') !== false) {
				$rawBody    = $readRawBodyFn
					? $readRawBodyFn()
					: $this->readRawBody();
				$bodyParams = ['query' => $rawBody ?? ''];
			} elseif (stripos($contentType, 'application/json') !== false) {
				$rawBody    = $readRawBodyFn ?
					$readRawBodyFn()
					: $this->readRawBody();
				$bodyParams = json_decode($rawBody ?? '', true);

				if (json_last_error()) {
					throw new RequestError('Could not parse JSON: ' . json_last_error_msg());
				}

				if (! is_array($bodyParams)) {
					throw new RequestError(
						'GraphQL Server expects JSON object or array, but got ' .
						Utils::printSafeJson($bodyParams)
					);
				}
			} elseif (stripos($contentType, 'application/x-www-form-urlencoded') !== false) {
				$bodyParams = \wp_unslash( $_POST );
			} elseif (stripos($contentType, 'multipart/form-data') !== false) {
				$bodyParams = \wp_unslash( $_POST );
			} else {
				throw new RequestError('Unexpected content type: ' . Utils::printSafeJson($contentType));
			}
		}

		return $this->parseRequestParams($method, $bodyParams, $urlParams);
	}

	/**
	 * Parses normalized request params and returns instance of OperationParams
	 * or array of OperationParams in case of batch operation.
	 *
	 * Returned value is a suitable input for `executeOperation` or `executeBatch` (if array)
	 *
	 * @param string  $method
	 * @param mixed[] $bodyParams
	 * @param mixed[] $queryParams
	 *
	 * @return OperationParams|OperationParams[]
	 *
	 * @throws RequestError
	 *
	 * @api
	 */
	public function parseRequestParams($method, array $bodyParams, array $queryParams)
	{
		if ($method === 'GET') {
			$result = OperationParams::create($queryParams, true);
		} elseif ($method === 'POST') {
			if (isset($bodyParams[0])) {
				$result = [];
				foreach ($bodyParams as $index => $entry) {
					$op       = OperationParams::create($entry);
					$result[] = $op;
				}
			} else {
				$result = OperationParams::create($bodyParams);
			}
		} else {
			throw new RequestError('HTTP Method "' . $method . '" is not supported');
		}

		return $result;
	}

	/**
	 * Checks validity of OperationParams extracted from HTTP request and returns an array of errors
	 * if params are invalid (or empty array when params are valid)
	 *
	 * @return array<int, RequestError>
	 *
	 * @api
	 */
	public function validateOperationParams(OperationParams $params)
	{
		$errors = [];
		if (! $params->query && ! $params->queryId) {
			$errors[] = new RequestError('GraphQL Request must include at least one of those two parameters: "query" or "queryId"');
		}

		if ($params->query && $params->queryId) {
			$errors[] = new RequestError('GraphQL Request parameters "query" and "queryId" are mutually exclusive');
		}

		if ($params->query !== null && ! is_string($params->query)) {
			$errors[] = new RequestError(
				'GraphQL Request parameter "query" must be string, but got ' .
				Utils::printSafeJson($params->query)
			);
		}

		if ($params->queryId !== null && ! is_string($params->queryId)) {
			$errors[] = new RequestError(
				'GraphQL Request parameter "queryId" must be string, but got ' .
				Utils::printSafeJson($params->queryId)
			);
		}

		if ($params->operation !== null && ! is_string($params->operation)) {
			$errors[] = new RequestError(
				'GraphQL Request parameter "operation" must be string, but got ' .
				Utils::printSafeJson($params->operation)
			);
		}

		if ($params->variables !== null && (! is_array($params->variables) || isset($params->variables[0]))) {
			$errors[] = new RequestError(
				'GraphQL Request parameter "variables" must be object or JSON string parsed to object, but got ' .
				Utils::printSafeJson($params->getOriginalInput('variables'))
			);
		}

		return $errors;
	}

	/**
	 * Executes GraphQL operation with given server configuration and returns execution result
	 * (or promise when promise adapter is different from SyncPromiseAdapter)
	 *
	 * @return ExecutionResult|Promise
	 *
	 * @api
	 */
	public function executeOperation(ServerConfig $config, OperationParams $op)
	{
		$promiseAdapter = $config->getPromiseAdapter() ?? Executor::getPromiseAdapter();
		$result         = $this->promiseToExecuteOperation($promiseAdapter, $config, $op);

		if ($promiseAdapter instanceof SyncPromiseAdapter) {
			$result = $promiseAdapter->wait($result);
		}

		return $result;
	}

	/**
	 * Executes batched GraphQL operations with shared promise queue
	 * (thus, effectively batching deferreds|promises of all queries at once)
	 *
	 * @param OperationParams[] $operations
	 *
	 * @return ExecutionResult|ExecutionResult[]|Promise
	 *
	 * @api
	 */
	public function executeBatch(ServerConfig $config, array $operations)
	{
		$promiseAdapter = $config->getPromiseAdapter() ?? Executor::getPromiseAdapter();
		$result         = [];

		foreach ($operations as $operation) {
			$result[] = $this->promiseToExecuteOperation($promiseAdapter, $config, $operation, true);
		}

		$result = $promiseAdapter->all($result);

		// Wait for promised results when using sync promises
		if ($promiseAdapter instanceof SyncPromiseAdapter) {
			$result = $promiseAdapter->wait($result);
		}

		return $result;
	}

	/**
	 * @param bool $isBatch
	 *
	 * @return Promise
	 */
	private function promiseToExecuteOperation(
		PromiseAdapter $promiseAdapter,
		ServerConfig $config,
		OperationParams $op,
		$isBatch = false
	) {
		try {
			if ($config->getSchema() === null) {
				throw new InvariantViolation('Schema is required for the server');
			}

			if ($isBatch && ! $config->getQueryBatching()) {
				throw new RequestError('Batched queries are not supported by this server');
			}

			$errors = $this->validateOperationParams($op);

			if (count($errors) > 0) {
				$errors = Utils::map(
					$errors,
					static function (RequestError $err) : Error {
						return Error::createLocatedError($err, null, null);
					}
				);

				return $promiseAdapter->createFulfilled(
					new ExecutionResult(null, $errors)
				);
			}

			$doc = $op->queryId
				? $this->loadPersistedQuery($config, $op)
				: $op->query;

			if (! $doc instanceof DocumentNode) {
				$doc = Parser::parse($doc);
			}

			$operationType = AST::getOperation($doc, $op->operation);

			if ($operationType === false) {
				throw new RequestError('Failed to determine operation type');
			}

			if ($operationType !== 'query' && $op->isReadOnly()) {
				throw new RequestError('GET supports only query operation');
			}

			$result = GraphQL::promiseToExecute(
				$promiseAdapter,
				$config->getSchema(),
				$doc,
				$this->resolveRootValue($config, $op, $doc, $operationType),
				$this->resolveContextValue($config, $op, $doc, $operationType),
				$op->variables,
				$op->operation,
				$config->getFieldResolver(),
				$this->resolveValidationRules($config, $op, $doc, $operationType)
			);
		} catch (RequestError $e) {
			$result = $promiseAdapter->createFulfilled(
				new ExecutionResult(null, [Error::createLocatedError($e)])
			);
		} catch (Error $e) {
			$result = $promiseAdapter->createFulfilled(
				new ExecutionResult(null, [$e])
			);
		}

		$applyErrorHandling = static function (ExecutionResult $result) use ($config) : ExecutionResult {
			if ($config->getErrorsHandler()) {
				$result->setErrorsHandler($config->getErrorsHandler());
			}
			if ($config->getErrorFormatter() || $config->getDebugFlag() !== DebugFlag::NONE) {
				$result->setErrorFormatter(
					FormattedError::prepareFormatter(
						$config->getErrorFormatter(),
						$config->getDebugFlag()
					)
				);
			}

			return $result;
		};

		return $result->then($applyErrorHandling);
	}

	/**
	 * @return mixed
	 *
	 * @throws RequestError
	 */
	private function loadPersistedQuery(ServerConfig $config, OperationParams $operationParams)
	{
		// Load query if we got persisted query id:
		$loader = $config->getPersistentQueryLoader();

		if ($loader === null) {
			throw new RequestError('Persisted queries are not supported by this server');
		}

		$source = $loader($operationParams->queryId, $operationParams);

		if (! is_string($source) && ! $source instanceof DocumentNode) {
			throw new InvariantViolation(sprintf(
				'Persistent query loader must return query string or instance of %s but got: %s',
				DocumentNode::class,
				Utils::printSafe($source)
			));
		}

		return $source;
	}

	/**
	 * @param string $operationType
	 *
	 * @return mixed[]|null
	 */
	private function resolveValidationRules(
		ServerConfig $config,
		OperationParams $params,
		DocumentNode $doc,
		$operationType
	) {
		// Allow customizing validation rules per operation:
		$validationRules = $config->getValidationRules();

		if (is_callable($validationRules)) {
			$validationRules = $validationRules($params, $doc, $operationType);

			if (! is_array($validationRules)) {
				throw new InvariantViolation(sprintf(
					'Expecting validation rules to be array or callable returning array, but got: %s',
					Utils::printSafe($validationRules)
				));
			}
		}

		return $validationRules;
	}

	/**
	 * @return mixed
	 */
	private function resolveRootValue(ServerConfig $config, OperationParams $params, DocumentNode $doc, string $operationType)
	{
		$rootValue = $config->getRootValue();

		if (is_callable($rootValue)) {
			$rootValue = $rootValue($params, $doc, $operationType);
		}

		return $rootValue;
	}

	/**
	 * @param string $operationType
	 *
	 * @return mixed
	 */
	private function resolveContextValue(
		ServerConfig $config,
		OperationParams $params,
		DocumentNode $doc,
		$operationType
	) {
		$context = $config->getContext();

		if (is_callable($context)) {
			$context = $context($params, $doc, $operationType);
		}

		return $context;
	}

	/**
	 * Send response using standard PHP `header()` and `echo`.
	 *
	 * @param Promise|ExecutionResult|ExecutionResult[] $result
	 * @param bool                                      $exitWhenDone
	 *
	 * @api
	 */
	public function sendResponse($result, $exitWhenDone = false)
	{
		if ($result instanceof Promise) {
			$result->then(function ($actualResult) use ($exitWhenDone) : void {
				$this->doSendResponse($actualResult, $exitWhenDone);
			});
		} else {
			$this->doSendResponse($result, $exitWhenDone);
		}
	}

	private function doSendResponse($result, $exitWhenDone)
	{
		$httpStatus = $this->resolveHttpStatus($result);
		$this->emitResponse($result, $httpStatus, $exitWhenDone);
	}

	/**
	 * @param mixed[]|JsonSerializable $jsonSerializable
	 * @param int                      $httpStatus
	 * @param bool                     $exitWhenDone
	 */
	public function emitResponse($jsonSerializable, $httpStatus, $exitWhenDone)
	{
		$body = json_encode($jsonSerializable);
		header('Content-Type: application/json', true, $httpStatus);
		echo $body;

		if ($exitWhenDone) {
			exit;
		}
	}

	/**
	 * @return bool|string
	 */
	private function readRawBody()
	{
		return file_get_contents('php://input');
	}

	/**
	 * @param ExecutionResult|mixed[] $result
	 *
	 * @return int
	 */
	private function resolveHttpStatus($result)
	{
		if (is_array($result) && isset($result[0])) {
			Utils::each(
				$result,
				static function ($executionResult, $index) : void {
					if (! $executionResult instanceof ExecutionResult) {
						throw new InvariantViolation(sprintf(
							'Expecting every entry of batched query result to be instance of %s but entry at position %d is %s',
							ExecutionResult::class,
							$index,
							Utils::printSafe($executionResult)
						));
					}
				}
			);
			$httpStatus = 200;
		} else {
			if (! $result instanceof ExecutionResult) {
				throw new InvariantViolation(sprintf(
					'Expecting query result to be instance of %s but got %s',
					ExecutionResult::class,
					Utils::printSafe($result)
				));
			}
			if ($result->data === null && count($result->errors) > 0) {
				$httpStatus = 200;
			} else {
				$httpStatus = 200;
			}
		}

		return $httpStatus;
	}
}
