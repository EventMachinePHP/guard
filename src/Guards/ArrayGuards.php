<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use ArrayAccess;
use function is_array;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating array values.
 *
 * @method static array a(mixed $value, ?string $message = null) @see Guard::isArray()
 * @method static array array(mixed $value, ?string $message = null) @see Guard::isArray()
 * @method static array is_array(mixed $value, ?string $message = null) @see Guard::isArray()
 */
trait ArrayGuards
{
    /**
     * Check if a value is an array and return it.
     *
     * If the value is not an array, an `InvalidArgumentException` is thrown.
     *
     * @param  mixed  $value The value to be checked if it's an array. This could be a numeric array, an associative array, or a multi-dimensional array.
     * @param  string|null  $message Custom error message to be thrown when the value is not an array. If this parameter is not provided, a default error message will be used.
     *
     * @return array The value if it's an array.
     *
     * @throws InvalidArgumentException If the value is not an array. The error message will either be the custom message passed in the `$message` parameter or a default error message.
     *
     * @see Guard::a()
     * @see Guard::array()
     * @see Guard::is_array()
     */
    #[Alias(['a', 'array', 'is_array'])]
    public static function isArray(mixed $value, ?string $message = null): array
    {
        return !is_array($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    public static function isArrayAccessible(mixed $value, ?string $message = null): array|ArrayAccess
    {
        return !is_array($value) && !($value instanceof ArrayAccess)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array or an object implementing ArrayAccess. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
