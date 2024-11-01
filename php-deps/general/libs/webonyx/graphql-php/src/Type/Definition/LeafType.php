<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type\Definition;

use Exception;
use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\BooleanValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FloatValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\IntValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NullValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\StringValueNode;

/*
export type GraphQLLeafType =
GraphQLScalarType |
GraphQLEnumType;
*/

interface LeafType
{
    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     *
     * @return mixed
     *
     * @throws Error
     */
    public function serialize($value);

    /**
     * Parses an externally provided value (query variable) to use as an input
     *
     * In the case of an invalid value this method must throw an Exception
     *
     * @param mixed $value
     *
     * @return mixed
     *
     * @throws Error
     */
    public function parseValue($value);

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input
     *
     * In the case of an invalid node or value this method must throw an Exception
     *
     * @param IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|NullValueNode $valueNode
     * @param mixed[]|null                                                               $variables
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function parseLiteral(Node $valueNode, ?array $variables = null);
}
