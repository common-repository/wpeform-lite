<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Language\AST;

class OperationDefinitionNode extends Node implements ExecutableDefinitionNode, HasSelectionSet
{
    /** @var string */
    public $kind = NodeKind::OPERATION_DEFINITION;

    /** @var NameNode|null */
    public $name;

    /** @var string (oneOf 'query', 'mutation', 'subscription')) */
    public $operation;

    /** @var NodeList<VariableDefinitionNode> */
    public $variableDefinitions;

    /** @var NodeList<DirectiveNode> */
    public $directives;

    /** @var SelectionSetNode */
    public $selectionSet;
}
