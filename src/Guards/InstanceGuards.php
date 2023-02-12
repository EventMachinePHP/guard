<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating instance values.
 *
 * @method static object io(mixed $value, string $class, ?string $message = null) @see Guard::isInstanceOf()
 * @method static object instanceOf(mixed $value, string $class, ?string $message = null) @see Guard::isInstanceOf()
 * @method static object is_instance_of(mixed $value, string $class, ?string $message = null) @see Guard::isInstanceOf()
 */
trait InstanceGuards
{
    /**
     * Verify if a value is an instance of a specified class.
     *
     * This method checks if a given value is an instance of the specified class.
     * If it's not, an `InvalidArgumentException` is thrown. If the value is an
     * instance of the specified class, it is returned as-is.
     *
     * The error message thrown by the `InvalidArgumentException` can be
     * customized by providing a `$message` argument. If not provided,
     * a default message is used, indicating the expected class name
     * and the actual type and string representation of the value.
     *
     * @param  mixed  $value The value to be checked if it's an instance of the specified class.
     * @param  string  $class The class name to check against.
     * @param  string|null  $message Custom error message to be thrown when the value is not an instance of the specified class.
     *
     * @return object The value if it's an instance of the specified class.
     *
     * @throws InvalidArgumentException If the value is not an instance of the specified class.
     *
     * @see Guard::io()
     * @see Guard::instanceOf()
     * @see Guard::is_instance_of()
     */
    #[Alias(['io', 'instanceOf', 'is_instance_of'])]
    public static function isInstanceOf(mixed $value, string $class, ?string $message = null): object
    {
        return !($value instanceof $class)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
    public static function notInstanceOf(mixed $value, string $class, ?string $message = null): mixed
    {
        return $value instanceof $class
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value not being an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    public static function isInstanceOfAny(mixed $value, array $classes, ?string $message = null): object
    {
        foreach ($classes as $class) {
            if ($value instanceof $class) {
                return $value;
            }
        }

        return throw InvalidArgumentException::create(
            customMessage: $message,
            defaultMessage: 'Expected an instance of any of %s. Got: %s (%s)',
            values: [implode(', ', $classes), self::valueToString($value), self::valueToType($value)],
        );
    }
}
