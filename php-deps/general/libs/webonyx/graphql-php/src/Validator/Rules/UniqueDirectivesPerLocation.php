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
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DirectiveNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\Node;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Directive;
use WPEForm\GeneralDeps\GraphQL\Validator\ASTValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

/**
 * Unique directive names per location
 *
 * A GraphQL document is only valid if all non-repeatable directives at
 * a given location are uniquely named.
 */
class UniqueDirectivesPerLocation extends ValidationRule
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
        $uniqueDirectiveMap = [];

        $schema            = $context->getSchema();
        $definedDirectives = $schema !== null
            ? $schema->getDirectives()
            : Directive::getInternalDirectives();
        foreach ($definedDirectives as $directive) {
            $uniqueDirectiveMap[$directive->name] = ! $directive->isRepeatable;
        }

        $astDefinitions = $context->getDocument()->definitions;
        foreach ($astDefinitions as $definition) {
            if (! ($definition instanceof DirectiveDefinitionNode)) {
                continue;
            }

            $uniqueDirectiveMap[$definition->name->value] = $definition->repeatable;
        }

        return [
            'enter' => static function (Node $node) use ($uniqueDirectiveMap, $context) : void {
                if (! isset($node->directives)) {
                    return;
                }

                $knownDirectives = [];

                /** @var DirectiveNode $directive */
                foreach ($node->directives as $directive) {
                    $directiveName = $directive->name->value;

                    if (! isset($uniqueDirectiveMap[$directiveName])) {
                        continue;
                    }

                    if (isset($knownDirectives[$directiveName])) {
                        $context->reportError(new Error(
                            self::duplicateDirectiveMessage($directiveName),
                            [$knownDirectives[$directiveName], $directive]
                        ));
                    } else {
                        $knownDirectives[$directiveName] = $directive;
                    }
                }
            },
        ];
    }

    public static function duplicateDirectiveMessage($directiveName)
    {
        return sprintf('The directive "%s" can only be used once at this location.', $directiveName);
    }
}
