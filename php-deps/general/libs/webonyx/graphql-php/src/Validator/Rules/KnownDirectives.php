<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator\Rules;

use Exception;
use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumValueDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentSpreadNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InlineFragmentNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InputObjectTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InputObjectTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InputValueDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InterfaceTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\InterfaceTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeList;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\OperationDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ScalarTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ScalarTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SchemaDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SchemaTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\UnionTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\UnionTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\DirectiveLocation;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Directive;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Validator\ASTValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function array_map;
use function count;
use function get_class;
use function in_array;
use function sprintf;

class KnownDirectives extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getSDLVisitor(SDLValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getASTVisitor(ASTValidationContext $context)
    {
        $locationsMap      = [];
        $schema            = $context->getSchema();
        $definedDirectives = $schema
            ? $schema->getDirectives()
            : Directive::getInternalDirectives();

        foreach ($definedDirectives as $directive) {
            $locationsMap[$directive->name] = $directive->locations;
        }

        $astDefinition = $context->getDocument()->definitions;

        foreach ($astDefinition as $def) {
            if (! ($def instanceof DirectiveDefinitionNode)) {
                continue;
            }

            $locationsMap[$def->name->value] = Utils::map(
                $def->locations,
                static function ($name) : string {
                    return $name->value;
                }
            );
        }

        return [
            NodeKind::DIRECTIVE => function (
                DirectiveNode $node,
                $key,
                $parent,
                $path,
                $ancestors
            ) use (
                $context,
                $locationsMap
            ) : void {
                $name      = $node->name->value;
                $locations = $locationsMap[$name] ?? null;

                if (! $locations) {
                    $context->reportError(new Error(
                        self::unknownDirectiveMessage($name),
                        [$node]
                    ));

                    return;
                }

                $candidateLocation = $this->getDirectiveLocationForASTPath($ancestors);

                if (! $candidateLocation || in_array($candidateLocation, $locations, true)) {
                    return;
                }
                $context->reportError(
                    new Error(
                        self::misplacedDirectiveMessage($name, $candidateLocation),
                        [$node]
                    )
                );
            },
        ];
    }

    public static function unknownDirectiveMessage($directiveName)
    {
        return sprintf('Unknown directive "%s".', $directiveName);
    }

    /**
     * @param Node[]|NodeList[] $ancestors The type is actually (Node|NodeList)[] but this PSR-5 syntax is so far not supported by most of the tools
     *
     * @return string
     */
    private function getDirectiveLocationForASTPath(array $ancestors)
    {
        $appliedTo = $ancestors[count($ancestors) - 1];
        switch (true) {
            case $appliedTo instanceof OperationDefinitionNode:
                switch ($appliedTo->operation) {
                    case 'query':
                        return DirectiveLocation::QUERY;
                    case 'mutation':
                        return DirectiveLocation::MUTATION;
                    case 'subscription':
                        return DirectiveLocation::SUBSCRIPTION;
                }
                break;
            case $appliedTo instanceof FieldNode:
                return DirectiveLocation::FIELD;
            case $appliedTo instanceof FragmentSpreadNode:
                return DirectiveLocation::FRAGMENT_SPREAD;
            case $appliedTo instanceof InlineFragmentNode:
                return DirectiveLocation::INLINE_FRAGMENT;
            case $appliedTo instanceof FragmentDefinitionNode:
                return DirectiveLocation::FRAGMENT_DEFINITION;
            case $appliedTo instanceof VariableDefinitionNode:
                return DirectiveLocation::VARIABLE_DEFINITION;
            case $appliedTo instanceof SchemaDefinitionNode:
            case $appliedTo instanceof SchemaTypeExtensionNode:
                return DirectiveLocation::SCHEMA;
            case $appliedTo instanceof ScalarTypeDefinitionNode:
            case $appliedTo instanceof ScalarTypeExtensionNode:
                return DirectiveLocation::SCALAR;
            case $appliedTo instanceof ObjectTypeDefinitionNode:
            case $appliedTo instanceof ObjectTypeExtensionNode:
                return DirectiveLocation::OBJECT;
            case $appliedTo instanceof FieldDefinitionNode:
                return DirectiveLocation::FIELD_DEFINITION;
            case $appliedTo instanceof InterfaceTypeDefinitionNode:
            case $appliedTo instanceof InterfaceTypeExtensionNode:
                return DirectiveLocation::IFACE;
            case $appliedTo instanceof UnionTypeDefinitionNode:
            case $appliedTo instanceof UnionTypeExtensionNode:
                return DirectiveLocation::UNION;
            case $appliedTo instanceof EnumTypeDefinitionNode:
            case $appliedTo instanceof EnumTypeExtensionNode:
                return DirectiveLocation::ENUM;
            case $appliedTo instanceof EnumValueDefinitionNode:
                return DirectiveLocation::ENUM_VALUE;
            case $appliedTo instanceof InputObjectTypeDefinitionNode:
            case $appliedTo instanceof InputObjectTypeExtensionNode:
                return DirectiveLocation::INPUT_OBJECT;
            case $appliedTo instanceof InputValueDefinitionNode:
                $parentNode = $ancestors[count($ancestors) - 3];

                return $parentNode instanceof InputObjectTypeDefinitionNode
                    ? DirectiveLocation::INPUT_FIELD_DEFINITION
                    : DirectiveLocation::ARGUMENT_DEFINITION;
        }

        throw new Exception('Unknown directive location: ' . get_class($appliedTo));
    }

    public static function misplacedDirectiveMessage($directiveName, $location)
    {
        return sprintf('Directive "%s" may not be used on "%s".', $directiveName, $location);
    }
}
