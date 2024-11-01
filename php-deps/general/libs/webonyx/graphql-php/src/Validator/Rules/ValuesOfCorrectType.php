<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator\Rules;

use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\BooleanValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\EnumValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\FloatValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\IntValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ListValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NullValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectFieldNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ObjectValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\StringValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ValueNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\VariableNode;
use WPEForm\GeneralDeps\GraphQL\Language\Printer;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\EnumValueDefinition;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\InputObjectType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ListOfType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\NonNull;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\ScalarType;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Type;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use Throwable;
use function array_combine;
use function array_keys;
use function array_map;
use function array_values;
use function iterator_to_array;
use function sprintf;

/**
 * Value literals of correct type
 *
 * A GraphQL document is only valid if all value literals are of the type
 * expected at their position.
 */
class ValuesOfCorrectType extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        $fieldName = '';

        return [
            NodeKind::FIELD        => [
                'enter' => static function (FieldNode $node) use (&$fieldName) : void {
                    $fieldName = $node->name->value;
                },
            ],
            NodeKind::NULL         => static function (NullValueNode $node) use ($context, &$fieldName) : void {
                $type = $context->getInputType();
                if (! ($type instanceof NonNull)) {
                    return;
                }

                $context->reportError(
                    new Error(
                        self::getBadValueMessage((string) $type, Printer::doPrint($node), null, $context, $fieldName),
                        $node
                    )
                );
            },
            NodeKind::LST          => function (ListValueNode $node) use ($context, &$fieldName) : ?VisitorOperation {
                // Note: TypeInfo will traverse into a list's item type, so look to the
                // parent input type to check if it is a list.
                $type = Type::getNullableType($context->getParentInputType());
                if (! $type instanceof ListOfType) {
                    $this->isValidScalar($context, $node, $fieldName);

                    return Visitor::skipNode();
                }

                return null;
            },
            NodeKind::OBJECT       => function (ObjectValueNode $node) use ($context, &$fieldName) : ?VisitorOperation {
                // Note: TypeInfo will traverse into a list's item type, so look to the
                // parent input type to check if it is a list.
                $type = Type::getNamedType($context->getInputType());
                if (! $type instanceof InputObjectType) {
                    $this->isValidScalar($context, $node, $fieldName);

                    return Visitor::skipNode();
                }
                unset($fieldName);
                // Ensure every required field exists.
                $inputFields  = $type->getFields();
                $nodeFields   = iterator_to_array($node->fields);
                $fieldNodeMap = array_combine(
                    array_map(
                        static function ($field) : string {
                            return $field->name->value;
                        },
                        $nodeFields
                    ),
                    array_values($nodeFields)
                );
                foreach ($inputFields as $fieldName => $fieldDef) {
                    $fieldType = $fieldDef->getType();
                    if (isset($fieldNodeMap[$fieldName]) || ! $fieldDef->isRequired()) {
                        continue;
                    }

                    $context->reportError(
                        new Error(
                            self::requiredFieldMessage($type->name, $fieldName, (string) $fieldType),
                            $node
                        )
                    );
                }

                return null;
            },
            NodeKind::OBJECT_FIELD => static function (ObjectFieldNode $node) use ($context) : void {
                $parentType = Type::getNamedType($context->getParentInputType());
                /** @var ScalarType|EnumType|InputObjectType|ListOfType|NonNull $fieldType */
                $fieldType = $context->getInputType();
                if ($fieldType || ! ($parentType instanceof InputObjectType)) {
                    return;
                }

                $suggestions = Utils::suggestionList(
                    $node->name->value,
                    array_keys($parentType->getFields())
                );
                $didYouMean  = $suggestions
                    ? 'Did you mean ' . Utils::orList($suggestions) . '?'
                    : null;

                $context->reportError(
                    new Error(
                        self::unknownFieldMessage($parentType->name, $node->name->value, $didYouMean),
                        $node
                    )
                );
            },
            NodeKind::ENUM         => function (EnumValueNode $node) use ($context, &$fieldName) : void {
                $type = Type::getNamedType($context->getInputType());
                if (! $type instanceof EnumType) {
                    $this->isValidScalar($context, $node, $fieldName);
                } elseif (! $type->getValue($node->value)) {
                    $context->reportError(
                        new Error(
                            self::getBadValueMessage(
                                $type->name,
                                Printer::doPrint($node),
                                $this->enumTypeSuggestion($type, $node),
                                $context,
                                $fieldName
                            ),
                            $node
                        )
                    );
                }
            },
            NodeKind::INT          => function (IntValueNode $node) use ($context, &$fieldName) : void {
                $this->isValidScalar($context, $node, $fieldName);
            },
            NodeKind::FLOAT        => function (FloatValueNode $node) use ($context, &$fieldName) : void {
                $this->isValidScalar($context, $node, $fieldName);
            },
            NodeKind::STRING       => function (StringValueNode $node) use ($context, &$fieldName) : void {
                $this->isValidScalar($context, $node, $fieldName);
            },
            NodeKind::BOOLEAN      => function (BooleanValueNode $node) use ($context, &$fieldName) : void {
                $this->isValidScalar($context, $node, $fieldName);
            },
        ];
    }

    public static function badValueMessage($typeName, $valueName, $message = null)
    {
        return sprintf('Expected type %s, found %s', $typeName, $valueName) .
            ($message ? "; ${message}" : '.');
    }

    /**
     * @param VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode $node
     */
    private function isValidScalar(ValidationContext $context, ValueNode $node, $fieldName)
    {
        // Report any error at the full type expected by the location.
        /** @var ScalarType|EnumType|InputObjectType|ListOfType|NonNull $locationType */
        $locationType = $context->getInputType();

        if (! $locationType) {
            return;
        }

        $type = Type::getNamedType($locationType);

        if (! $type instanceof ScalarType) {
            $context->reportError(
                new Error(
                    self::getBadValueMessage(
                        (string) $locationType,
                        Printer::doPrint($node),
                        $this->enumTypeSuggestion($type, $node),
                        $context,
                        $fieldName
                    ),
                    $node
                )
            );

            return;
        }

        // Scalars determine if a literal value is valid via parseLiteral() which
        // may throw to indicate failure.
        try {
            $type->parseLiteral($node);
        } catch (Throwable $error) {
            // Ensure a reference to the original error is maintained.
            $context->reportError(
                new Error(
                    self::getBadValueMessage(
                        (string) $locationType,
                        Printer::doPrint($node),
                        $error->getMessage(),
                        $context,
                        $fieldName
                    ),
                    $node,
                    null,
                    [],
                    null,
                    $error
                )
            );
        }
    }

    /**
     * @param VariableNode|NullValueNode|IntValueNode|FloatValueNode|StringValueNode|BooleanValueNode|EnumValueNode|ListValueNode|ObjectValueNode $node
     */
    private function enumTypeSuggestion($type, ValueNode $node)
    {
        if ($type instanceof EnumType) {
            $suggestions = Utils::suggestionList(
                Printer::doPrint($node),
                array_map(
                    static function (EnumValueDefinition $value) : string {
                        return $value->name;
                    },
                    $type->getValues()
                )
            );

            return $suggestions ? 'Did you mean the enum value ' . Utils::orList($suggestions) . '?' : null;
        }
    }

    public static function badArgumentValueMessage($typeName, $valueName, $fieldName, $argName, $message = null)
    {
        return sprintf('Field "%s" argument "%s" requires type %s, found %s', $fieldName, $argName, $typeName, $valueName) .
            ($message ? sprintf('; %s', $message) : '.');
    }

    public static function requiredFieldMessage($typeName, $fieldName, $fieldTypeName)
    {
        return sprintf('Field %s.%s of required type %s was not provided.', $typeName, $fieldName, $fieldTypeName);
    }

    public static function unknownFieldMessage($typeName, $fieldName, $message = null)
    {
        return sprintf('Field "%s" is not defined by type %s', $fieldName, $typeName) .
            ($message ? sprintf('; %s', $message) : '.');
    }

    private static function getBadValueMessage($typeName, $valueName, $message = null, $context = null, $fieldName = null)
    {
        if ($context) {
            $arg = $context->getArgument();
            if ($arg) {
                return self::badArgumentValueMessage($typeName, $valueName, $fieldName, $arg->name, $message);
            }
        }

        return self::badValueMessage($typeName, $valueName, $message);
    }
}
