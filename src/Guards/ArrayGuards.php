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
 * @method static array a(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static array array(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static array is_array(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static ArrayAccess|array aa(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 * @method static ArrayAccess|array array_accessible(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 * @method static ArrayAccess|array is_array_accessible(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 */
trait ArrayGuards
{
    /**
     * Validates if the given value is an array and returns it.
     *
     * Throws an {@see InvalidArgumentException} if the value
     * is not an array.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message Custom error message.
     *
     * @return array The value as an array.
     *
     * @throws InvalidArgumentException If the value is not an array.
     *
     * @see Alias: Guard::a()
     * @see Alias: Guard::array()
     * @see Alias: Guard::is_array()
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

    /**
     * Validates if the given value is either an array or implements
     * {@see ArrayAccess} and returns it.
     *
     * This method checks if the given value is either an array or
     * an object that implements the {@see ArrayAccess} interface.
     * If the value is not an array or {@see ArrayAccess}, it
     * throws an {@see InvalidArgumentException} with a
     * custom or default error message.
     *
     * @param  mixed  $value The value to be checked.
     * @param  string|null  $message Optional custom error message.
     *
     * @return array|ArrayAccess The value if it is either an array or implements ArrayAccess.
     *
     * @throws InvalidArgumentException If the value is not an array or ArrayAccess.
     *
     * @see Alias: Guard::aa()
     * @see Alias: Guard::array_accessible()
     * @see Alias: Guard::is_array_accessible()
     */
    #[Alias(['aa', 'array_accessible', 'is_array_accessible'])]
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
