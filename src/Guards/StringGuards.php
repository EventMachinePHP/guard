<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_string;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating string values.
 *
 * @method static string s(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string str(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string string(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string is_string(mixed $value, ?string $message = null) @see Guard::isString()
 * @method static string sne(mixed $value, ?string $message = null) @see Guard::isStringNotEmpty()
 * @method static string strNotEmpty(mixed $value, ?string $message = null) @see Guard::isStringNotEmpty()
 * @method static string stringNotEmpty(mixed $value, ?string $message = null) @see Guard::isStringNotEmpty()
 */
trait StringGuards
{
    /**
     * Validates if the given value is a string and returns it.
     *
     * This method throws an {@see InvalidArgumentException} if
     * the input value is not a string. If a custom error
     * message is provided, it will be used instead of
     * the default message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message The custom error message, if desired.
     *
     * @return string The input value, if it is a string.
     *
     * @throws InvalidArgumentException If the input value is not a string.
     *
     * @see Guard::s()
     * @see Guard::str()
     * @see Guard::string()
     * @see Guard::is_string()
     */
    #[Alias(['s', 'str', 'string', 'is_string'])]
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
     * Validatess if the given value is a non-empty string and returns it.
     *
     * If the value is not a string or is an empty string, an
     * {@see InvalidArgumentException} exception is thrown.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return string The validated value.
     *
     * @throws InvalidArgumentException If the validation fails.
     *
     * @see Guard::sne()
     * @see Guard::strNotEmpty()
     * @see Guard::stringNotEmpty()
     */
    #[Alias(['sne', 'strNotEmpty', 'stringNotEmpty'])]
    public static function isStringNotEmpty(mixed $value, ?string $message = null): string
    {
        self::isString($value, $message);
        self::notEqualTo($value, '', $message);

        return $value;
    }
}
