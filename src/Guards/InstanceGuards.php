<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_a;
use function is_string;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating instance values.
 *
 * @method static object ia(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object iio(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object is_a(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object isA(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object instanceOf(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static object is_instance_of(mixed $value, string $class, ?string $message = null) Alias of {@see Guard::isInstanceOf()}}
 * @method static mixed ioe(mixed $value, array $classes, ?string $message = null) Alias of {@see Guard::isInstanceOfAny()}}
 * @method static mixed instanceOfAny(mixed $value, array $classes, ?string $message = null) Alias of {@see Guard::isInstanceOfAny()}}
 * @method static mixed iao(mixed $value, mixed $class, ?string $message = null) Alias of {@see Guard::isAOf()}}
 * @method static mixed a_of(mixed $value, mixed $class, ?string $message = null) Alias of {@see Guard::isAOf()}}
 */
trait InstanceGuards
{
    /**
     * Validates if the value is an instance of the
     * given class and returns it.
     *
     * Verifies if the value is an instance of the specified class. If the
     * check fails, an {@see InvalidGuardArgumentException} is thrown with a
     * custom or default message.
     *
     * @param  mixed  $value     The value to check.
     * @param  string  $class     The class to check the value against.
     * @param  string|null  $message The custom message for the exception.
     *
     * @throws InvalidGuardArgumentException if the check fails.
     *
     * @see Alias: {@see Guard::ia()}
     * @see Alias: {@see Guard::iio()}
     * @see Alias: {@see Guard::is_a()}
     * @see Alias: {@see Guard::isA()}
     * @see Alias: {@see Guard::instanceOf()}
     * @see Alias: {@see Guard::is_instance_of()}
     */
    #[Alias(['ia', 'iio', 'is_a', 'isA', 'instanceOf', 'is_instance_of'])]
    public static function isInstanceOf(mixed $value, string $class, ?string $message = null): object
    {
        return !($value instanceof $class)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is an instance of at least
     * one of the given classes and returns it.
     *
     * This method checks if the given value is an instance of at
     * least one of the classes in the `$classes` array. If it is
     * not, an {@see InvalidGuardArgumentException} will be thrown
     * with a message indicating which classes were expected
     * and what value was received instead.
     *
     * @param  mixed  $value The value to be validated.
     * @param  array  $classes The list of classes that the value should be an instance of.
     * @param  string|null  $message The custom error message to use, if any.
     *
     * @return mixed The validated value.
     *
     * @throws InvalidGuardArgumentException If the value is not an instance of any of the given classes.
     *
     * @see Alias: {@see Guard::ioe()}
     * @see Alias: {@see Guard::instanceOfAny()}
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

        return throw InvalidGuardArgumentException::create(
            customMessage: $message,
            defaultMessage: 'Expected an instance of any of %s. Got: %s (%s)',
            values: [implode(', ', $classes), self::valueToString(value: $value), self::valueToType(value: $value)],
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
     * it throws an {@see InvalidGuardArgumentException}.
     *
     * @param  mixed  $value The value to check.
     * @param  mixed  $class The class name to check the value against.
     * @param  string|null  $message The error message to be thrown with the exception.
     *
     * @return mixed The original value if the check passes.
     *
     * @throws InvalidGuardArgumentException If the value is not an instance of the specified class or of one of its parents.
     *
     * @see Alias: {@see Guard::iao()}
     * @see Alias: {@see Guard::a_of()}
     */
    #[Alias(['iao', 'a_of'])]
    public static function isAOf(mixed $value, mixed $class, ?string $message = null): mixed
    {
        return !is_string($class) || !class_exists($class) || !is_a($value, $class, is_string($value))
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of this class or to this class among its parents "%s". Got: %s (%s)',
                values: [$class, self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
