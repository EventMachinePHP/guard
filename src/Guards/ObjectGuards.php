<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_object;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains guards that check if a value is of type object.
 *
 * @method static object o (mixed $value, ?string $message = null) @see Guard::isObject()
 * @method static object object (mixed $value, ?string $message = null) @see Guard::isObject()
 * @method static object is_object (mixed $value, ?string $message = null) @see Guard::isObject()
 */
trait ObjectGuards
{
    /**
     * Check if the given value is an object.
     *
     * This method checks if the given value is an object and returns the value if it is.
     * If the value is not an object, an `InvalidArgumentException` will be thrown with
     * a custom or default error message.
     *
     * @param  mixed  $value The value to check if it is an object.
     * @param  string|null  $message [optional] The custom error message to use if the value is not an object.
     *
     * @return object The given value if it is an object.
     *
     * @throws InvalidArgumentException If the given value is not an object.
     *
     * @see Guard::o()
     * @see Guard::object()
     * @see Guard::is_object()
     */
    #[Alias(['is_object', 'object', 'o'])]
    public static function isObject(mixed $value, ?string $message = null): object
    {
        return !is_object($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an object. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
