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
use WPEForm\GeneralDeps\GraphQL\Language\AST\FragmentSpreadNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\NodeKind;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function sprintf;

class KnownFragmentNames extends ValidationRule
{
    public function getVisitor(ValidationContext $context)
    {
        return [
            NodeKind::FRAGMENT_SPREAD => static function (FragmentSpreadNode $node) use ($context) : void {
                $fragmentName = $node->name->value;
                $fragment     = $context->getFragment($fragmentName);
                if ($fragment) {
                    return;
                }

                $context->reportError(new Error(
                    self::unknownFragmentMessage($fragmentName),
                    [$node->name]
                ));
            },
        ];
    }

    /**
     * @param string $fragName
     */
    public static function unknownFragmentMessage($fragName)
    {
        return sprintf('Unknown fragment "%s".', $fragName);
    }
}
