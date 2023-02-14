<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_a;
use function is_string;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating instance values.
 *
 * @method static object ia(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object iio(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object is_a(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object isA(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object instanceOf(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object is_instance_of(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static mixed nio(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isNotInstanceOf()}}
 * @method static mixed notInstanceOf(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isNotInstanceOf()}}
 * @method static mixed ioe(mixed $value, array $classes, ?string $message = null) Alias of {@see Guard::isInstanceOfAny()}}
 * @method static mixed instanceOfAny(mixed $value, array $classes, ?string $message = null) Alias of {@see Guard::isInstanceOfAny()}}
 * @method static mixed iao(mixed $value, mixed $class, ?string $message = null) Alias of {@see Guard::isAOf()}}
 * @method static mixed is_a_of(mixed $value, mixed $class, ?string $message = null) Alias of {@see Guard::isAOf()}}
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
     * @see Alias: Guard::ia()
     * @see Alias: Guard::iio()
     * @see Alias: Guard::is_a()
     * @see Alias: Guard::isA()
     * @see Alias: Guard::instanceOf()
     * @see Alias: Guard::is_instance_of()
     */
    #[Alias(['ia', 'iio', 'is_a', 'isA', 'instanceOf', 'is_instance_of'])]
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
     * @see Alias: Guard::nio()
     * @see Alias: Guard::notInstanceOf()
     *
     * TODO: Consider moving this to NotGuards?
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
     * @see Alias: Guard::ioe()
     * @see Alias: Guard::instanceOfAny()
     *
     * TODO: Consider moving this to OfAny Guards?
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

    /**
     * Validates if a given value is an instance of a class or
     * of a class among its parents.
     *
     * This method checks if a value is an instance of a class or
     * of a class among its parents. It first checks if the class
     * exists and then checks if the value is an instance of the
     * specified class or of one of its parents. If it's not,
     * it throws an {@see InvalidArgumentException}.
     *
     * @param  mixed  $value The value to check.
     * @param  mixed  $class The class name to check the value against.
     * @param  string|null  $message The error message to be thrown with the exception.
     *
     * @return mixed The original value if the check passes.
     *
     * @throws InvalidArgumentException If the value is not an instance of the specified class or of one of its parents.
     *
     * @see Alias: Guard::iao()
     * @see Alias: Guard::is_a_of()
     */
    #[Alias(['iao', 'is_a_of'])]
    public static function isAOf(mixed $value, mixed $class, ?string $message = null): mixed
    {
        Guard::isClassExists($class);

        return !is_a($value, $class, is_string($value))
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of this class or to this class among its parents "%s". Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
