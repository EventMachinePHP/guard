<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use DateTime;
use Countable;
use ArrayAccess;
use function is_bool;
use DateTimeImmutable;
use function is_array;
use function is_float;
use function get_class;
use function is_object;
use function is_scalar;
use function is_string;
use function is_numeric;
use function is_callable;
use function is_resource;
use function method_exists;
use function get_resource_type;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

class Guard
{
    // TODO: Method aliases
    // TODO: Core_c: Loop through interfaces, using instance of
    // TODO: Look for php aliases methods
    // TODO: standard_5: function is_ (Search)
    // TODO: Look for examples on php.net for native functions, use them in tests
    // TODO: * @see number_of() :alias:
    // TODO: Update type tests using IntegerTest cases

    // region Strings

    /**
     * Validate if the value passed is of type string.
     *
     * This method takes two parameters: `$value` and `$message`. The `$value` parameter is of type mixed,
     * which means it can accept any type of data. The `$message` parameter is of type string and is optional.
     * If the `$value` passed is not of type string, an `InvalidArgumentException` is thrown with the provided
     * custom error message or a default error message. If the `$value` is of type string, it is returned without
     * modification.
     *
     * ```php
     * // returns 'hello'
     * Guard::string('hello');
     *
     * // throws an InvalidArgumentException with default message
     * Guard::string(123);
     *
     * // throws an InvalidArgumentException with custom message
     * Guard::string(123, 'A string is expected');
     * ```
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message The custom error message to be used if the validation fails.
     *
     * @return string The `$value` if it is of type string.
     *
     * @throws InvalidArgumentException If the `$value` passed is not of type string.
     */
    public static function string(mixed $value, ?string $message = null): string
    {
        return !is_string($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a string. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    /**
     * Validate if the value passed is of type string and is not empty.
     *
     * This method takes two parameters: `$value` and `$message`. The `$value` parameter is of type mixed,
     * which means it can accept any type of data. The `$message` parameter is of type string and is optional.
     * The method first validates if the `$value` is of type string using the `string` method. If the `$value`
     * is not of type string, an `InvalidArgumentException` is thrown with the provided custom error message or
     * a default error message. Then, it validates if the `$value` is not equal to an empty string using the
     * `notEqualTo` method. If the `$value` is equal to an empty string, an `InvalidArgumentException` is thrown
     * with the provided custom error message or a default error message. If both validations pass, the `$value`
     * is returned without modification.
     *
     * ```php
     * // returns 'hello'
     * Guard::stringNotEmpty('hello');
     *
     * // throws an InvalidArgumentException with default message
     * Guard::stringNotEmpty(123);
     * Guard::stringNotEmpty('');
     *
     * // throws an InvalidArgumentException with custom message
     * Guard::stringNotEmpty(123, 'A non-empty string is expected');
     * Guard::stringNotEmpty('', 'A non-empty string is expected');
     * ```
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message The custom error message to be used if the validation fails.
     *
     * @return string The `$value` if it is of type string and is not equal to an empty string.
     *
     * @throws InvalidArgumentException If the `$value` passed is not of type string or is equal to an empty string.
     */
    public static function stringNotEmpty(mixed $value, ?string $message = null): string
    {
        self::string($value, $message);
        self::notEqualTo($value, '', $message);

        return $value;
    }

    // endregion

    // region Integers

    /**
     * Validate if the value passed is of type integer.
     *
     * This method takes two parameters: `$value` and `$message`. The `$value` parameter is of type mixed,
     * which means it can accept any type of data. The `$message` parameter is of type string and is optional.
     * If the `$value` passed is not of type integer, an `InvalidArgumentException` is thrown with the provided
     * custom error message or a default error message. If the `$value` is of type integer, it is returned without
     * modification.
     *
     * ```php
     * // returns 123
     * Guard::integer(123);
     *
     * // throws an InvalidArgumentException with default message
     * Guard::integer('123');
     *
     * // throws an InvalidArgumentException with custom message
     * Guard::integer('123', 'An integer is expected');
     * ```
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message The custom error message to be used if the validation fails.
     *
     * @return int The `$value` if it is of type integer.
     *
     * @throws InvalidArgumentException If the `$value` passed is not of type integer.
     */
    public static function integer(mixed $value, ?string $message = null): int
    {
        return !is_int($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer. Got: %s',
                values: [get_debug_type($value)],
            )
            : $value;
    }

    public static function integerish(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value) || $value != (int) $value
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integerish value. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function positiveInteger(mixed $value, ?string $message = null): int
    {
        self::integer($value, $message);
        self::greaterThan($value, 0, $message);

        return $value;
    }

    public static function naturalInteger(mixed $value, ?string $message = null): int
    {
        self::integer($value, $message);
        self::greaterThanOrEqual($value, 0, $message);

        return $value;
    }

    // endregion

    // region Floats

    public static function float(mixed $value, ?string $message = null): float
    {
        return !is_float($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a float. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Numerics

    public static function numeric(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a numeric value. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Booleans

    public static function boolean(mixed $value, ?string $message = null): bool
    {
        return !is_bool($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a boolean value. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Scalars

    public static function scalar(mixed $value, ?string $message = null): string|int|float|bool
    {
        return !is_scalar($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a scalar value. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Objects

    public static function object(mixed $value, ?string $message = null): object
    {
        return !is_object($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an object. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Resources

    public static function resource(mixed $value, ?string $type = null, ?string $message = null)
    {
        if (!is_resource($value)) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            );
        }

        if ($type !== null && get_resource_type($value) !== $type) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource of type: %s. Got: %s',
                values: [$type, get_resource_type($value)],
            );
        }

        return $value;
    }

    // endregion

    // region Callables

    public static function isCallable(mixed $value, ?string $message = null): callable
    {
        return !is_callable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a callable. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Arrays

    public static function isArray(mixed $value, ?string $message = null): array
    {
        return !is_array($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function isArrayAccessible(mixed $value, ?string $message = null): array|ArrayAccess
    {
        return !is_array($value) && !($value instanceof ArrayAccess)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array or an object implementing ArrayAccess. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Countables

    public static function isCountable(mixed $value, ?string $message = null): Countable|array
    {
        return !is_countable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a countable value. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Iterables

    public static function isIterable(mixed $value, ?string $message = null): iterable
    {
        return !is_iterable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an iterable. Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Instances

    public static function isInstanceOf(mixed $value, string $class, ?string $message = null): object
    {
        return !($value instanceof $class)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function notInstanceOf(mixed $value, string $class, ?string $message = null): mixed
    {
        return $value instanceof $class
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value not being an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), get_debug_type($value)],
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
            values: [implode(', ', $classes), self::valueToString($value), get_debug_type($value)],
        );
    }

    // endregion

    // region Equality

    public static function equalTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value != $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value), self::valueToString($expect), get_debug_type($expect)],
            )
            : $value;
    }

    public static function notEqualTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value == $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value different from: %s (%s). Got: %s (%s)',
                values: [self::valueToString($value), get_debug_type($value), self::valueToString($expect), get_debug_type($expect)],
            )
            : $value;
    }

    // endregion

    // region Comparisons

    public static function greaterThan(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value <= $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value greater than: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), get_debug_type($limit), self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function greaterThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value < $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value greater than or equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), get_debug_type($limit), self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function lessThan(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value >= $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value less than: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), get_debug_type($limit), self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    public static function lessThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value > $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value less than or equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), get_debug_type($limit), self::valueToString($value), get_debug_type($value)],
            )
            : $value;
    }

    // endregion

    // region Protected Methods

    protected static function valueToString(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                return get_class($value).': '.self::valueToString($value->__toString());
            }

            if ($value instanceof DateTime || $value instanceof DateTimeImmutable) {
                return get_class($value).': '.self::valueToString($value->format('c'));
            }

            return get_class($value);
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (is_string($value)) {
            return '"'.$value.'"';
        }

        return (string) $value;
    }

    protected static function valueToType(mixed $value): string
    {
        return get_debug_type($value);
    }

    // endregion
}
