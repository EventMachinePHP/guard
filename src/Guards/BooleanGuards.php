<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_bool;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating boolean values.
 *
 * @method static bool b(mixed $value, ?string $message = null) @see Guard::isBoolean()
 * @method static bool bool(mixed $value, ?string $message = null) @see Guard::isBoolean()
 * @method static bool is_bool(mixed $value, ?string $message = null) @see Guard::isBoolean()
 * @method static bool boolean(mixed $value, ?string $message = null) @see Guard::isBoolean()
 */
trait BooleanGuards
{
    /**
     * Validates if a given value is a boolean.
     *
     * This method takes in a mixed value as its first argument
     * and an optional string message as its second argument.
     *
     * If the value is not a boolean, the method throws an
     * InvalidArgumentException with the given or default message.
     *
     * @param  mixed  $value The value to be validated
     * @param  string|null  $message [optional] Custom error message to be used in case of an exception
     *
     * @return bool The boolean value if validation is successful
     *
     * @throws InvalidArgumentException If the value is not a boolean
     */
    #[Alias(['boolean', 'is_bool', 'bool', 'b'])]
    public static function isBoolean(mixed $value, ?string $message = null): bool
    {
        return !is_bool($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a boolean value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
