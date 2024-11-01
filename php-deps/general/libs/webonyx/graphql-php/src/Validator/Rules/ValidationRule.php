<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator\Rules;

use WPEForm\GeneralDeps\GraphQL\Validator\SDLValidationContext;
use WPEForm\GeneralDeps\GraphQL\Validator\ValidationContext;
use function class_alias;

abstract class ValidationRule
{
    /** @var string */
    protected $name;

    public function getName()
    {
        return $this->name === '' || $this->name === null  ? static::class : $this->name;
    }

    public function __invoke(ValidationContext $context)
    {
        return $this->getVisitor($context);
    }

    /**
     * Returns structure suitable for GraphQL\Language\Visitor
     *
     * @see \WPEForm\GeneralDeps\GraphQL\Language\Visitor
     *
     * @return mixed[]
     */
    public function getVisitor(ValidationContext $context)
    {
        return [];
    }

    /**
     * Returns structure suitable for GraphQL\Language\Visitor
     *
     * @see \WPEForm\GeneralDeps\GraphQL\Language\Visitor
     *
     * @return mixed[]
     */
    public function getSDLVisitor(SDLValidationContext $context)
    {
        return [];
    }
}

class_alias(ValidationRule::class, 'WPEForm\GeneralDeps\GraphQL\Validator\Rules\AbstractValidationRule');
