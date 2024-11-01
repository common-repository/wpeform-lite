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
use WPEForm\GeneralDeps\GraphQL\Language\AST\InputValueDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Language\Visitor;
use WPEForm\GeneralDeps\GraphQL\Language\VisitorOperation;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\Directive;
use WPEForm\GeneralDeps\GraphQL\Type\Definition\FieldArgument;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use WPEForm\GeneralDeps\GraphQL\Validator\ASTValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function array_map;
use function in_array;
use function sprintf;

/**
 * Known argument names on directives
 *
 * A GraphQL directive is only valid if all supplied arguments are defined by
 * that field.
 */
class KnownArgumentNamesOnDirectives extends ValidationRule
{
    /**
     * @param string[] $suggestedArgs
     */
    public static function unknownDirectiveArgMessage($argName, $directiveName, array $suggestedArgs)
    {
        $message = sprintf('Unknown argument "%s" on directive "@%s".', $argName, $directiveName);
        if (isset($suggestedArgs[0])) {
            $message .= sprintf(' Did you mean %s?', Utils::quotedOrList($suggestedArgs));
        }

        return $message;
    }

    public function getSDLVisitor(SDLValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getVisitor(ValidationContext $context)
    {
        return $this->getASTVisitor($context);
    }

    public function getASTVisitor(ASTValidationContext $context)
    {
        $directiveArgs     = [];
        $schema            = $context->getSchema();
        $definedDirectives = $schema !== null ? $schema->getDirectives() : Directive::getInternalDirectives();

        foreach ($definedDirectives as $directive) {
            $directiveArgs[$directive->name] = array_map(
                static function (FieldArgument $arg) : string {
                    return $arg->name;
                },
                $directive->args
            );
        }

        $astDefinitions = $context->getDocument()->definitions;
        foreach ($astDefinitions as $def) {
            if (! ($def instanceof DirectiveDefinitionNode)) {
                continue;
            }

            $name = $def->name->value;
            if ($def->arguments !== null) {
                $directiveArgs[$name] = Utils::map(
                    $def->arguments ?? [],
                    static function (InputValueDefinitionNode $arg) : string {
                        return $arg->name->value;
                    }
                );
            } else {
                $directiveArgs[$name] = [];
            }
        }

        return [
            NodeKind::DIRECTIVE => static function (DirectiveNode $directiveNode) use ($directiveArgs, $context) : VisitorOperation {
                $directiveName = $directiveNode->name->value;
                $knownArgs     = $directiveArgs[$directiveName] ?? null;

                if ($directiveNode->arguments === null || $knownArgs === null) {
                    return Visitor::skipNode();
                }

                foreach ($directiveNode->arguments as $argNode) {
                    $argName = $argNode->name->value;
                    if (in_array($argName, $knownArgs, true)) {
                        continue;
                    }

                    $suggestions = Utils::suggestionList($argName, $knownArgs);
                    $context->reportError(new Error(
                        self::unknownDirectiveArgMessage($argName, $directiveName, $suggestions),
                        [$argNode]
                    ));
                }

                return Visitor::skipNode();
            },
        ];
    }
}
