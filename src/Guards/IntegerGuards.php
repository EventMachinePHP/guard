<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_int;
use function is_numeric;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains guards that check if a value is of type integer.
 *
 * @method static int i (mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int int (mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int is_int (mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int integer (mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static string|int|float n (mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float numeric (mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float is_numeric (mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float intVal (mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static string|int|float integerish (mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static string|int|float integerValue (mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static int positiveInt (mixed $value, ?string $message = null) @see Guard::isPositiveInteger()
 * @method static int positiveInteger (mixed $value, ?string $message = null) @see Guard::isPositiveInteger()
 * @method static int naturalInt (mixed $value, ?string $message = null) @see Guard::isNaturalInteger()
 * @method static int naturalInteger (mixed $value, ?string $message = null) @see Guard::isNaturalInteger()
 */
trait IntegerGuards
{
    /**
     * Checks if the given value is of type integer and returns it.
     *
     * This method is used to ensure that the input value is of the
     * correct type. If the value is not of type integer, an
     * `InvalidArgumentException` will be thrown.
     *
     * The exception message can include a custom message (if provided)
     * or a default message indicating that an integer was expected,
     * and includes a string representation of the actual value received.
     *
     * @param  mixed  $value The value to check
     * @param  string|null  $message [optional] A custom message to use in the exception, if thrown
     *
     * @return int The given value, if it is of type integer
     *
     * @throws InvalidArgumentException If the value is not of type integer
     */
    #[Alias(['integer', 'is_int', 'int', 'i'])]
    public static function isInteger(mixed $value, ?string $message = null): int
    {
        return !is_int($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer. Got: %s',
                values: [self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Check if the given value is numeric.
     *
     * This method checks if the given value is numeric and throws an
     * InvalidArgumentException with a custom or default message if
     * the value is not numeric.
     *
     * @param  mixed  $value The value to be checked.
     * @param  string|null  $message A custom error message. If not provided, a default message will be used.
     *
     * @return string|int|float The given value if it is numeric.
     *
     * @throws InvalidArgumentException If the value is not numeric.
     */
    #[Alias(['is_numeric', 'numeric', 'n'])]
    public static function isNumeric(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a numeric value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Checks if the given value can be cast to an integer, float or string, and returns it.
     *
     * This method is used to ensure that the input value is of a type
     * that can be cast to either an integer, float or string. If
     * the value is not of a type that can be cast to one of
     * these types, an `InvalidArgumentException` will be
     * thrown.
     *
     * The exception message can include a custom message (if provided)
     * or a default message indicating that an integer, float or
     * string value was expected, and includes a string
     * representation of the actual value received.
     *
     * @param  mixed  $value The value to check
     * @param  string|null  $message [optional] A custom message to use in the exception, if thrown
     *
     * @return int|float|string The given value, if it can be cast to an integer, float or string
     *
     * @throws InvalidArgumentException If the value is not of a type that can be cast to an integer, float or string
     */
    #[Alias(['integerValue', 'integerish', 'intVal'])]
    public static function isIntegerValue(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value) || $value != (int) $value
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an isIntegerValue value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Checks if the given value is a positive integer.
     *
     * This method is used to ensure that the input value is a
     * positive integer. If the value is not a positive
     * integer, an `InvalidArgumentException` will be
     * thrown.
     *
     * The exception message can include a custom message
     * (if provided) or a default message indicating
     * that a positive integer was expected, and
     * includes a string representation of the
     * actual value received.
     *
     * @param  mixed  $value The value to check
     * @param  string|null  $message [optional] A custom message to use in the exception, if thrown
     *
     * @return int The given value, if it is a positive integer
     *
     * @throws InvalidArgumentException If the value is not a positive integer
     */
    #[Alias(['positiveInteger', 'positiveInt'])]
    public static function isPositiveInteger(mixed $value, ?string $message = null): int
    {
        self::isInteger($value, $message);
        self::greaterThan($value, 0, $message);

        return $value;
    }

    /**
     * Checks if the given value is a natural integer.
     *
     * This method is used to ensure that the input value is a
     * non-negative integer. If the value is not a natural
     * integer, an `InvalidArgumentException` will be
     * thrown.
     *
     * The exception message can include a custom message (if provided)
     * or a default message indicating that a natural integer was
     * expected, and includes a string representation of the
     * actual value received.
     *
     * @param  mixed  $value The value to check
     * @param  string|null  $message [optional] A custom message to use in the exception, if thrown
     *
     * @return int The given value, if it is a natural integer
     *
     * @throws InvalidArgumentException If the value is not a natural integer
     */
    #[Alias(['naturalInteger', 'naturalInt'])]
    public static function isNaturalInteger(mixed $value, ?string $message = null): int
    {
        self::isInteger($value, $message);
        self::greaterThanOrEqual($value, 0, $message);

        return $value;
    }
}
