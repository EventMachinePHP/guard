<?php

namespace EventMachinePHP\Guard;

use DateTime;
use DateTimeImmutable;
use function is_array;
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

    /**
     * @see \StringTest::string
     */
    public static function string(mixed $value, ?string $message = null): string
    {
        return !is_string($value)
            ? throw InvalidArgumentException::create($message, 'Expected a string. Got: %s', get_debug_type($value))
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
        if (!is_int($value)) {
            throw InvalidArgumentException::create($message ?:
                'Expected an integer. '.
                'Got: '.get_debug_type($value)
            );
        }

        return $value;
    }

    public static function integerish(mixed $value, ?string $message = null): string|int|float
    {
        if (!is_numeric($value) || $value != (int) $value) {
            throw InvalidArgumentException::create($message ?:
                sprintf('Expected an integerish value. Got: %s (%s)', self::valueToString($value), get_debug_type($value))
            );
        }

        return $value;
    }

    public static function positiveInteger(mixed $value, ?string $message = null): int
    {
        self::integer($value, $message);
        self::greaterThan($value, 0, $message);

        return $value;
    }

    //endregion

    //region Equality

    public static function equalTo(mixed $value, mixed $other, ?string $message = null): mixed
    {
        if ($value != $other) {
            throw InvalidArgumentException::create($message ?:
                'Expected a value equal to: '.self::valueToString($value).
                '. Got: '.self::valueToString($other)
            );
        }

        return $value;
    }

    public static function notEqualTo(mixed $value, mixed $other, ?string $message = null): mixed
    {
        if ($value == $other) {
            throw InvalidArgumentException::create($message ?:
                'Expected a value different from: '.self::valueToString($value).
                '. Got: '.self::valueToString($other)
            );
        }

        return $value;
    }

    //endregion

    //region Comparisons

    public static function greaterThan(mixed $value, mixed $other, ?string $message = null): mixed
    {
        if ($value <= $other) {
            throw InvalidArgumentException::create($message ?:
                'Expected a value greater than: '.self::valueToString($value).
                '. Got: '.self::valueToString($other)
            );
        }

        return $value;
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

    //endregion
}
