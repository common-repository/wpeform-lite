<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Experimental\Executor;

use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SelectionSetNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ValueNode;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ResolveInfo;

/**
 * @internal
 */
class CoroutineContextShared
{
    /** @var FieldNode[] */
    public $fieldNodes;

    /** @var string */
    public $fieldName;

    /** @var string */
    public $resultName;

    /** @var ValueNode[]|null */
    public $argumentValueMap;

    /** @var SelectionSetNode|null */
    public $mergedSelectionSet;

    /** @var ObjectType|null */
    public $typeGuard1;

    /** @var callable|null */
    public $resolveIfType1;

    /** @var mixed */
    public $argumentsIfType1;

    /** @var ResolveInfo|null */
    public $resolveInfoIfType1;

    /** @var ObjectType|null */
    public $typeGuard2;

    /** @var CoroutineContext[]|null */
    public $childContextsIfType2;

    /**
     * @param FieldNode[]  $fieldNodes
     * @param mixed[]|null $argumentValueMap
     */
    public function __construct(array $fieldNodes, string $fieldName, string $resultName, ?array $argumentValueMap)
    {
        $this->fieldNodes       = $fieldNodes;
        $this->fieldName        = $fieldName;
        $this->resultName       = $resultName;
        $this->argumentValueMap = $argumentValueMap;
    }
}
