<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_int;
use function is_float;
use function is_numeric;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating numeric values.
 *
 * @method static int i(mixed $value, ?string $message = null) Alias of {@see Guard::isInteger()}
 * @method static int int(mixed $value, ?string $message = null) Alias of {@see Guard::isInteger()}
 * @method static int is_int(mixed $value, ?string $message = null) Alias of {@see Guard::isInteger()}
 * @method static int integer(mixed $value, ?string $message = null) Alias of {@see Guard::isInteger()}
 * @method static int naturalInt(mixed $value, ?string $message = null) Alias of {@see Guard::isNaturalInteger()}
 * @method static int naturalInteger(mixed $value, ?string $message = null) Alias of {@see Guard::isNaturalInteger()}
 * @method static int positiveInt(mixed $value, ?string $message = null) Alias of {@see Guard::isPositiveInteger()}
 * @method static int positiveInteger(mixed $value, ?string $message = null) Alias of {@see Guard::isPositiveInteger()}
 * @method static int negativeInt(mixed $value, ?string $message = null) Alias of {@see Guard::isNegativeInteger()}
 * @method static int negativeInteger(mixed $value, ?string $message = null) Alias of {@see Guard::isNegativeInteger()}
 * @method static string|int|float nu(mixed $value, ?string $message = null) Alias of {@see Guard::isNumeric()}
 * @method static string|int|float numeric(mixed $value, ?string $message = null) Alias of {@see Guard::isNumeric()}
 * @method static string|int|float is_numeric(mixed $value, ?string $message = null) Alias of {@see Guard::isNumeric()}
 * @method static string|int|float intVal(mixed $value, ?string $message = null) Alias of {@see Guard::isIntegerValue()}
 * @method static string|int|float integerish(mixed $value, ?string $message = null) Alias of {@see Guard::isIntegerValue()}
 * @method static string|int|float integerValue(mixed $value, ?string $message = null) Alias of {@see Guard::isIntegerValue()}
 * @method static float fl(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 * @method static float float(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 * @method static float is_float(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 * @method static float positiveFloat(mixed $value, ?string $message = null) Alias of {@see Guard::isPositiveFloat()}
 * @method static float negativeFloat(mixed $value, ?string $message = null) Alias of {@see Guard::isNegativeFloat()}
 * @method static string|int|float digit(mixed $value, ?string $message = null) Alias of {@see Guard::isDigit()}
 */
trait NumericGuards
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
     * @throws InvalidGuardArgumentException If the value is not an integer.
     *
     * @see Alias: {@see Guard::i()}
     * @see Alias: {@see Guard::int()}
     * @see Alias: {@see Guard::is_int()}
     * @see Alias: {@see Guard::integer()}
     */
    #[Alias(['i', 'int', 'is_int', 'integer'])]
    public static function isInteger(mixed $value, ?string $message = null): int
    {
        return !is_int($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer. Got: %s',
                values: [self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a natural integer and returns it.
     *
     * A natural integer is an integer that is greater than or equal to 0.
     * The given value will be checked for being an integer and for being
     * greater than or equal to 0. If either of these conditions is not
     * met, an {@see InvalidGuardArgumentException} will be thrown.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return int The validated value.
     *
     * @throws InvalidGuardArgumentException If the value is not a natural integer.
     *
     * @see Alias: {@see Guard::naturalInt()}
     * @see Alias: {@see Guard::naturalInteger()}
     */
    #[Alias(['naturalInt', 'naturalInteger'])]
    public static function isNaturalInteger(mixed $value, ?string $message = null): int
    {
        return !is_int($value) || $value < 0
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer value greater than or equal to 0 (int). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a positive integer and returns it.
     *
     * This method will validate that the given value is an integer
     * using the {@see Guard::isInteger()} method, and that the
     * value is greater than 0. If the value is not a positive
     * integer, an {@see InvalidGuardArgumentException} is thrown
     * with the given message, or a default message if not
     * provided.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the value is not a positive integer.
     *
     * @return int The validated positive integer.
     *
     * @throws InvalidGuardArgumentException If the value is not a positive integer.
     *
     * @see Alias: {@see Guard::positiveInt()}
     * @see Alias: {@see Guard::positiveInteger()}
     */
    #[Alias(['positiveInt', 'positiveInteger'])]
    public static function isPositiveInteger(mixed $value, ?string $message = null): int
    {
        return !is_int($value) || $value <= 0
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer value greater than 0 (int). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a negative integer and returns it.
     *
     * This method will validate that the given value is an integer and
     * the value is greater than 0. If the value is not a negative
     * integer, an {@see InvalidGuardArgumentException} is thrown
     * with the given message, or a default message if not
     * provided.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the value is not a positive integer.
     *
     * @return int The validated positive integer.
     *
     * @throws InvalidGuardArgumentException If the value is not a positive integer.
     *
     * @see Alias: {@see Guard::negativeInt()}
     * @see Alias: {@see Guard::negativeInteger()}
     */
    #[Alias(['negativeInt', 'negativeInteger'])]
    public static function isNegativeInteger(mixed $value, ?string $message = null): int
    {
        return !is_int($value) || $value >= 0
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an integer value greater than 0 (int). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is numeric and returns it.
     *
     * The method checks if the passed value is numeric and returns
     * it if it is. If it's not numeric, an {@see InvalidGuardArgumentException}
     * is thrown with a custom or default error message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message A custom error message.
     *
     * @return string|int|float The passed value if it's numeric.
     *
     * @throws InvalidGuardArgumentException If the value is not numeric.
     *
     * @see Alias: {@see Guard::nu()}
     * @see Alias: {@see Guard::numeric()}
     * @see Alias: {@see Guard::is_numeric()}
     */
    #[Alias(['nu', 'numeric', 'is_numeric'])]
    public static function isNumeric(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a numeric value. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
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
     * @throws InvalidGuardArgumentException If the value is not a numeric value or
     * not equal to its integer representation.
     *
     * @see Alias: {@see Guard::intVal()}
     * @see Alias: {@see Guard::integerish()}
     * @see Alias: {@see Guard::integerValue()}
     */
    #[Alias(['intVal', 'integerish', 'integerValue'])]
    public static function isIntegerValue(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value) || $value != (int) $value
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an isIntegerValue value. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a float and returns it.
     *
     * This method checks if the given value is a float and returns
     * the value if it's a float. If the value is not a float, an
     * {@see InvalidGuardArgumentException} is thrown with a custom
     * message if provided or a default error message.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The custom error message.
     *
     * @return float The validated float value.
     *
     * @throws InvalidGuardArgumentException If the value is not a float.
     *
     * @see Alias: {@see Guard::fl()}
     * @see Alias: {@see Guard::float()}
     * @see Alias: {@see Guard::is_float()}
     */
    #[Alias(['fl', 'float', 'is_float'])]
    public static function isFloat(mixed $value, ?string $message = null): float
    {
        return !is_float($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a float. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * @see Alias: {@see Guard::positiveFloat()}
     */
    #[Alias(['positiveFloat'])]
    public static function isPositiveFloat(mixed $value, ?string $message = null): float
    {
        return !is_float($value) || $value <= 0
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a float value greater than 0 (float). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * @see Alias: {@see Guard::negativeFloat()}
     */
    #[Alias(['negativeFloat'])]
    public static function isNegativeFloat(mixed $value, ?string $message = null): float
    {
        return !is_float($value) || $value >= 0
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a float value less than 0 (float). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * @see Alias: {@see Guard::digit()}
     */
    #[Alias(['digit'])]
    public static function isDigit(mixed $value, ?string $message = null): string|int|float
    {
        return !is_numeric($value) || $value < 0 || $value > 9
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a digit. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
