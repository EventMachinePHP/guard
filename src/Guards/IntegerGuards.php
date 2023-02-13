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
 * @method static int i(mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int int(mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int is_int(mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static int integer(mixed $value, ?string $message = null) @see Guard::isInteger()
 * @method static string|int|float n(mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float numeric(mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float is_numeric(mixed $value, ?string $message = null) @see Guard::isNumeric()
 * @method static string|int|float intVal(mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static string|int|float integerish(mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static string|int|float integerValue(mixed $value, ?string $message = null) @see Guard::isIntegerValue()
 * @method static int positiveInt(mixed $value, ?string $message = null) @see Guard::isPositiveInteger()
 * @method static int positiveInteger(mixed $value, ?string $message = null) @see Guard::isPositiveInteger()
 * @method static int naturalInt(mixed $value, ?string $message = null) @see Guard::isNaturalInteger()
 * @method static int naturalInteger(mixed $value, ?string $message = null) @see Guard::isNaturalInteger()
 */
trait IntegerGuards
{
    /**
     * Validates if the given value is an integer and returns it.
     *
     * This method checks if a value is an integer and throws an
     * exception if it is not. The value is passed as an
     * argument and the exception message can be
     * customized using the `$message` argument.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message [optional] The exception message.
     *
     * @return int The integer value.
     *
     * @throws InvalidArgumentException If the value is not an integer.
     *
     * @see Guard::i()
     * @see Guard::int()
     * @see Guard::is_int()
     * @see Guard::integer()
     */
    #[Alias(['i', 'int', 'is_int', 'integer'])]
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
     * Validates if the given value is numeric and returns it.
     *
     * The method checks if the passed value is numeric and returns
     * it if it is. If it's not numeric, an {@see InvalidArgumentException}
     * is thrown with a custom or default error message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message A custom error message.
     *
     * @return string|int|float The passed value if it's numeric.
     *
     * @throws InvalidArgumentException If the value is not numeric.
     *
     * @see Guard::n()
     * @see Guard::numeric()
     * @see Guard::is_numeric()
     */
    #[Alias(['n', 'numeric', 'is_numeric'])]
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
     * Validates if the given value is an integer value.
     *
     * This method checks if the given value is a numeric value and
     * also equal to its integer representation.
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message An optional custom error message.
     *
     * @throws InvalidArgumentException If the value is not a numeric value or
     * not equal to its integer representation.
     *
     * @see Guard::intVal()
     * @see Guard::integerish()
     * @see Guard::integerValue()
     */
    #[Alias(['intVal', 'integerish', 'integerValue'])]
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
     * Validates if the given value is a positive integer and returns it.
     *
     * This method will validate that the given value is an integer
     * using the {@see Guard::isInteger()} method, and that the
     * value is greater than 0. If the value is not a positive
     * integer, an {@see InvalidArgumentException} is thrown
     * with the given message, or a default message if not
     * provided.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the value is not a positive integer.
     *
     * @return int The validated positive integer.
     *
     * @throws InvalidArgumentException If the value is not a positive integer.
     *
     * @see Guard::positiveInt()
     * @see Guard::positiveInteger()
     */
    #[Alias(['positiveInt', 'positiveInteger'])]
    public static function isPositiveInteger(mixed $value, ?string $message = null): int
    {
        self::isInteger($value, $message);
        self::isGreaterThan($value, 0, $message);

        return $value;
    }

    /**
     * Validates if the given value is a natural integer and returns it.
     *
     * A natural integer is an integer that is greater than or equal to 0.
     * The given value will be checked for being an integer and for being
     * greater than or equal to 0. If either of these conditions is not
     * met, an {@see InvalidArgumentException} will be thrown.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return int The validated value.
     *
     * @throws InvalidArgumentException If the value is not a natural integer.
     *
     * @see Guard::naturalInt()
     * @see Guard::naturalInteger()
     */
    #[Alias(['naturalInt', 'naturalInteger'])]
    public static function isNaturalInteger(mixed $value, ?string $message = null): int
    {
        self::isInteger($value, $message);
        self::isGreaterThanOrEqual($value, 0, $message);

        return $value;
    }
}
