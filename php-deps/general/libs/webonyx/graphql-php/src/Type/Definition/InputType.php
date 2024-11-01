<?php
/**
 * @license MIT
 *
 * Modified by swashata on 31-July-2021 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

declare(strict_types=1);

namespace WPEForm\GeneralDeps\GraphQL\Type\Definition;

/**
export type InputType =
  | ScalarType
  | EnumType
  | InputObjectType
  | ListOfType<InputType>
  | NonNull<
      | ScalarType
      | EnumType
      | InputObjectType
      | ListOfType<InputType>,
    >;
 */
interface InputType
{
}
