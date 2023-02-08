<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use DateTime;
use DateTimeImmutable;
use function is_array;
use function is_float;
use function get_class;
use function is_object;
use function is_string;
use function is_numeric;
use function is_resource;
use function method_exists;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

class Guard
{
    //region Strings

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

    public static function stringNotEmpty(mixed $value, ?string $message = null): string
    {
        self::string($value, $message);
        self::notEqualTo($value, '', $message);

        return $value;
    }

    //endregion

    //region Integers

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

    //endregion

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

    //region Numerics

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

    //endregion

    //region Equality

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

    //endregion

    //region Comparisons

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

    //endregion

    //region Protected Methods

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

    //endregion
}
