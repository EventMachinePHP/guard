<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_string;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating string values.
 *
 * @method static string s(mixed $value, ?string $message = null) Alias of {@see Guard::isString()}
 * @method static string str(mixed $value, ?string $message = null) Alias of {@see Guard::isString()}
 * @method static string string(mixed $value, ?string $message = null) Alias of {@see Guard::isString()}
 * @method static string is_string(mixed $value, ?string $message = null) Alias of {@see Guard::isString()}
 * @method static string sne(mixed $value, ?string $message = null) Alias of {@see Guard::isStringNonEmpty()}
 * @method static string strNonEmpty(mixed $value, ?string $message = null) Alias of {@see Guard::isStringNonEmpty()}
 * @method static string stringNonEmpty(mixed $value, ?string $message = null) Alias of {@see Guard::isStringNonEmpty()}
 * @method static string nonEmptyString(mixed $value, ?string $message = null) Alias of {@see Guard::isStringNonEmpty()}
 * @method static string stc(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringContains()}
 * @method static string contains(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringContains()}
 * @method static string str_contains(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringContains()}
 * @method static string stringContains(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringContains()}
 * @method static string stsw(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringStartsWith()}
 * @method static string starts_with(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringStartsWith()}
 * @method static string str_starts_with(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringStartsWith()}
 * @method static string stringStartsWith(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringStartsWith()}
 * @method static string stew(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringEndsWith()}
 * @method static string ends_with(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringEndsWith()}
 * @method static string str_ends_with(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringEndsWith()}
 * @method static string stringEndsWith(mixed $value, mixed $subString, ?string $message = null) Alias of {@see Guard::isStringEndsWith()}
 */
trait StringGuards
{
    /**
     * Validates if the given value is a string and returns it.
     *
     * This method throws an {@see InvalidGuardArgumentException} if
     * the input value is not a string. If a custom error
     * message is provided, it will be used instead of
     * the default message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message The custom error message, if desired.
     *
     * @return string The input value, if it is a string.
     *
     * @throws InvalidGuardArgumentException If the input value is not a string.
     *
     * @see Alias: {@see Guard::s()}
     * @see Alias: {@see Guard::str()}
     * @see Alias: {@see Guard::string()}
     * @see Alias: {@see Guard::is_string()}
     */
    #[Alias(['s', 'str', 'string', 'is_string'])]
    public static function isString(mixed $value, ?string $message = null): string
    {
        return !is_string($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a string. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a non-empty string and returns it.
     *
     * If the value is not a string or is an empty string, an
     * {@see InvalidGuardArgumentException} exception is thrown.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return string The validated value.
     *
     * @throws InvalidGuardArgumentException If the validation fails.
     *
     * @see Alias: {@see Guard::sne()}
     * @see Alias: {@see Guard::strNonEmpty()}
     * @see Alias: {@see Guard::stringNonEmpty()}
     * @see Alias: {@see Guard::nonEmptyString()}
     */
    #[Alias(['sne', 'strNonEmpty', 'stringNonEmpty', 'nonEmptyString'])]
    public static function isStringNonEmpty(mixed $value, ?string $message = null): string
    {
        return (!is_string($value) || $value === '')
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a non-empty-string. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given string contains a substring and retuns it.
     *
     * This method checks if the input `$value` is a string and if it
     * contains the `$subString`. If the input `$value` is not a
     * string or if it does not contain the `$subString`, an
     * {@see InvalidGuardArgumentException} will be thrown
     * with the custom message, or the default message.
     *
     * @param  mixed  $value The input value to be checked
     * @param  mixed  $subString The substring to check if it exists in the input value
     * @param  string|null  $message The custom error message to use, or `null` to use the default message
     *
     * @return string The input value, if it is a string and contains the `$subString`
     *
     * @throws InvalidGuardArgumentException If the input value is not a string or does not contain the `$subString`
     *
     * @see Alias: {@see Guard::stc()}
     * @see Alias: {@see Guard::contains()}
     * @see Alias: {@see Guard::str_contains()}
     * @see Alias: {@see Guard::stringContains()}
     */
    #[Alias(['stc', 'contains', 'str_contains', 'stringContains'])]
    public static function isStringContains(mixed $value, mixed $subString, ?string $message = null): string
    {
        return
            !is_string($value) ||
            !is_string($subString) ||
            !str_contains($value, $subString)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a string containing "%s". Got: %s (%s)',
                values: [$subString, self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates that the given value starts with the specified substring
     * and returns it.
     *
     * This method verifies that the provided value is a string and starts
     * with the specified substring. If the value is not a string or does
     * not start with the specified substring, an {@see InvalidGuardArgumentException}
     * is thrown.
     *
     * @param  mixed  $value The value to check.
     * @param  mixed  $subString The substring that the value should start with.
     * @param  string|null  $message An optional custom error message.
     *
     * @return string The original value if it is a string and starts with the specified substring.
     *
     *@throws InvalidGuardArgumentException If the value is not a string or does not start with
     *     the specified substring.
     *
     * @see Alias: {@see Guard::stsw()}
     * @see Alias: {@see Guard::starts_with()}
     * @see Alias: {@see Guard::str_starts_with()}
     * @see Alias: {@see Guard::stringStartsWith()}
     */
    #[Alias(['stsw', 'starts_with', 'str_starts_with', 'stringStartsWith'])]
    public static function isStringStartsWith(mixed $value, mixed $subString, ?string $message = null): string
    {
        return
            !is_string($value) ||
            !is_string($subString) ||
            !str_starts_with($value, $subString)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a string starting with "%s". Got: %s (%s)',
                values: [$subString, self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates that the given value ends with the specified substring
     * and returns it.
     *
     * This method verifies that the provided value is a string and ends
     * with the specified substring. If the value is not a string or does
     * not end with the specified substring, an {@see InvalidGuardArgumentException}
     * is thrown.
     *
     * @param  mixed  $value The value to check.
     * @param  mixed  $subString The substring that the value should start with.
     * @param  string|null  $message An optional custom error message.
     *
     * @return string The original value if it is a string and ends with the specified substring.
     *
     *@throws InvalidGuardArgumentException If the value is not a string or does not end with
     *     the specified substring.
     *
     * @see Alias: {@see Guard::stew()}
     * @see Alias: {@see Guard::ends_with()}
     * @see Alias: {@see Guard::str_ends_with()}
     * @see Alias: {@see Guard::stringEndsWith()}
     */
    #[Alias(['stew', 'ends_with', 'str_ends_with', 'stringEndsWith'])]
    public static function isStringEndsWith(mixed $value, mixed $subString, ?string $message = null): string
    {
        return
            !is_string($value) ||
            !is_string($subString) ||
            !str_ends_with($value, $subString)
                ? throw InvalidGuardArgumentException::create(
                    customMessage: $message,
                    defaultMessage: 'Expected a string ending with "%s". Got: %s (%s)',
                    values: [$subString, self::valueToString(value: $value), self::valueToType(value: $value)],
                )
                : $value;
    }
}
