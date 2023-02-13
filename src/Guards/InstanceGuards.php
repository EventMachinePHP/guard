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
 * @method static mixed nio(mixed $value, string $class, ?string $message = null) @see Guard::isNotInstanceOf()
 * @method static mixed notInstanceOf(mixed $value, string $class, ?string $message = null) @see Guard::isNotInstanceOf()
 * @method static mixed ioe(mixed $value, array $classes, ?string $message = null) @see Guard::isInstanceOfAny()
 * @method static mixed instanceOfAny(mixed $value, array $classes, ?string $message = null) @see Guard::isInstanceOfAny()
 */
trait InstanceGuards
{
    /**
     * Validates if the value is an instance of the
     * given class and returns it.
     *
     * Verifies if the value is an instance of the specified class. If the
     * check fails, an {@see InvalidArgumentException} is thrown with a
     * custom or default message.
     *
     * @param  mixed  $value     The value to check.
     * @param  string  $class     The class to check the value against.
     * @param  string|null  $message The custom message for the exception.
     *
     * @throws InvalidArgumentException if the check fails.
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

    /**
     * Validates if the given value is not an instance
     * of a specified class and returns it.
     *
     * This method checks if the given value is not an instance of the
     * specified class. If it is, an {@see InvalidArgumentException}
     * is thrown. If the value is not an instance of the class,
     * the value is returned.
     *
     * @param  mixed  $value The value to check.
     * @param  string  $class The class name to check against.
     * @param  string|null  $message The error message to use when an exception is thrown.
     *
     * @return mixed The value if it is not an instance of the specified class.
     *
     * @throws InvalidArgumentException If the value is an instance of the specified class.
     *
     * @see Guard::nio()
     * @see Guard::notInstanceOf()
     */
    #[Alias(['nio', 'notInstanceOf'])]
    public static function isNotInstanceOf(mixed $value, string $class, ?string $message = null): mixed
    {
        return $value instanceof $class
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value not being an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is an instance of at least
     * one of the given classes and returns it.
     *
     * This method checks if the given value is an instance of at
     * least one of the classes in the `$classes` array. If it is
     * not, an {@see InvalidArgumentException} will be thrown
     * with a message indicating which classes were expected
     * and what value was received instead.
     *
     * @param  mixed  $value The value to be validated.
     * @param  array  $classes The list of classes that the value should be an instance of.
     * @param  string|null  $message The custom error message to use, if any.
     *
     * @return mixed The validated value.
     *
     * @throws InvalidArgumentException If the value is not an instance of any of the given classes.
     *
     * @see Guard::ioe()
     * @see Guard::instanceOfAny()
     */
    #[Alias(['ioe', 'instanceOfAny'])]
    public static function isInstanceOfAny(mixed $value, array $classes, ?string $message = null): mixed
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
