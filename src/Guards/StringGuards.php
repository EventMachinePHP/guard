<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_string;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating string values.
 *
 * @method static string str(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string string(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string stringNotEmpty(mixed $value, ?string $message = null) @see Guard::isStringNotEmpty()
 * @method static string strNotEmpty(mixed $value, ?string $message = null) @see Guard::isStringNotEmpty()
 */
trait StringGuards
{
    /**
     * Validate that the provided value is of type string.
     *
     * This method checks if the `$value` argument is of type string. If it is not, an
     * `InvalidArgumentException` is thrown. The exception message can either be a custom
     * error message or a default error indicating the actual type and string representation
     * of the `$value`.
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message The custom error message to be thrown in case of validation failure.
     *
     * @return string The validated string value.
     *
     * @throws InvalidArgumentException If the provided value is not a string.
     *
     * @alias string
     */
    #[Alias(['string', 'str'])]
    public static function isString(mixed $value, ?string $message = null): string
    {
        return !is_string($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a string. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a string and is not equal to an empty string.
     *
     * This method first calls the `isString` method to validate if the given value is a string.
     * If the value is not a string, an InvalidArgumentException is thrown with the custom or default error message.
     * Then, the method calls the `notEqualTo` method to validate if the given value is not equal to an empty string.
     * If the value is equal to an empty string, an InvalidArgumentException is thrown with the custom or default error message.
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message The custom error message to use if the validation fails.
     *
     * @return string The string value if the validation is successful.
     *
     * @throws InvalidArgumentException If the value is not a string or if it is equal to an empty string.
     */
    #[Alias(['stringNotEmpty', 'strNotEmpty'])]
    public static function isStringNotEmpty(mixed $value, ?string $message = null): string
    {
        self::isString($value, $message);
        self::notEqualTo($value, '', $message);

        return $value;
    }
}
