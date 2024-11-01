<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Validator;

use WPEForm\GeneralDeps\GraphQL\Error\Error;
use WPEForm\GeneralDeps\GraphQL\Language\AST\DocumentNode;
use WPEForm\GeneralDeps\GraphQL\Type\Schema;

abstract class ASTValidationContext
{
    /** @var DocumentNode */
    protected $ast;

    /** @var Error[] */
    protected $errors;

    /** @var Schema */
    protected $schema;

    public function __construct(DocumentNode $ast, ?Schema $schema = null)
    {
        $this->ast    = $ast;
        $this->schema = $schema;
        $this->errors = [];
    }

    public function reportError(Error $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return Error[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return DocumentNode
     */
    public function getDocument()
    {
        return $this->ast;
    }

    public function getSchema() : ?Schema
    {
        return $this->schema;
    }
}
