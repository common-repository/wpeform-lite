<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Experimental\Executor;

use WPEForm\GeneralDeps\GraphQL\Language\AST\ValueNode;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ListOfType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\NonNull;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ScalarType;

/**
 * @internal
 */
interface Runtime
{
    /**
     * @param ScalarType|EnumType|InputObjectType|ListOfType|NonNull $type
     */
    public function evaluate(ValueNode $valueNode, InputType $type);

    public function addError($error);
}
