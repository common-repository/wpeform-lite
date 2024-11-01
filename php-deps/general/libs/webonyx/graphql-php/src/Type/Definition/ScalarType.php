<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type\Definition;

use WPEForm\GeneralDeps\GraphQL\Language\AST\ScalarTypeDefinitionNode;
use WPEForm\GeneralDeps\GraphQL\Language\AST\ScalarTypeExtensionNode;
use WPEForm\GeneralDeps\GraphQL\Utils\Utils;
use function is_string;

/**
 * Scalar Type Definition
 *
 * The leaf values of any request and input values to arguments are
 * Scalars (or Enums) and are defined with a name and a series of coercion
 * functions used to ensure validity.
 *
 * Example:
 *
 * class OddType extends ScalarType
 * {
 *     public $name = 'Odd',
 *     public function serialize($value)
 *     {
 *         return $value % 2 === 1 ? $value : null;
 *     }
 * }
 */
abstract class ScalarType extends Type implements OutputType, InputType, LeafType, NullableType, NamedType
{
    /** @var ScalarTypeDefinitionNode|null */
    public $astNode;

    /** @var ScalarTypeExtensionNode[] */
    public $extensionASTNodes;

    /**
     * @param mixed[] $config
     */
    public function __construct(array $config = [])
    {
        $this->name              = $config['name'] ?? $this->tryInferName();
        $this->description       = $config['description'] ?? $this->description;
        $this->astNode           = $config['astNode'] ?? null;
        $this->extensionASTNodes = $config['extensionASTNodes'] ?? null;
        $this->config            = $config;

        Utils::invariant(is_string($this->name), 'Must provide name.');
    }
}
