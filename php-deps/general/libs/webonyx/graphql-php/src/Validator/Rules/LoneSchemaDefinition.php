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
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\AST\SchemaDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;

/**
 * Lone Schema definition
 *
 * A GraphQL document is only valid if it contains only one schema definition.
 */
class LoneSchemaDefinition extends ValidationRule
{
    public static function schemaDefinitionNotAloneMessage()
    {
        return 'Must provide only one schema definition.';
    }

    public static function canNotDefineSchemaWithinExtensionMessage()
    {
        return 'Cannot define a new schema within a schema extension.';
    }

    public function getSDLVisitor(SDLValidationContext $context)
    {
        $oldSchema      = $context->getSchema();
        $alreadyDefined = $oldSchema !== null
            ? (
                $oldSchema->getAstNode() !== null ||
                $oldSchema->getQueryType() !== null ||
                $oldSchema->getMutationType() !== null ||
                $oldSchema->getSubscriptionType() !== null
            )
            : false;

        $schemaDefinitionsCount = 0;

        return [
            NodeKind::SCHEMA_DEFINITION => static function (SchemaDefinitionNode $node) use ($alreadyDefined, $context, &$schemaDefinitionsCount) : void {
                if ($alreadyDefined !== false) {
                    $context->reportError(new Error(self::canNotDefineSchemaWithinExtensionMessage(), $node));

                    return;
                }

                if ($schemaDefinitionsCount > 0) {
                    $context->reportError(new Error(self::schemaDefinitionNotAloneMessage(), $node));
                }

                ++$schemaDefinitionsCount;
            },
        ];
    }
}
