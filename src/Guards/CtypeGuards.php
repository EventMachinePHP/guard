<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating ctype checkable values.
 *
 * @method static mixed alnum(mixed $value, ?string $message = null) Alias of {@see Guard::isAlphanumeric()}
 * @method static mixed alphanumeric(mixed $value, ?string $message = null) Alias of {@see Guard::isAlphanumeric()}
 * @method static mixed alpha(mixed $value, ?string $message = null) Alias of {@see Guard::isAlphabetic()}
 * @method static mixed alphabetic(mixed $value, ?string $message = null) Alias of {@see Guard::isAlphabetic()}
 * @method static mixed cntrl(mixed $value, ?string $message = null) Alias of {@see Guard::isControlCharacter()}
 * @method static mixed controlCharacter(mixed $value, ?string $message = null) Alias of {@see Guard::isControlCharacter()}
 * @method static mixed digit(mixed $value, ?string $message = null) Alias of {@see Guard::isDigitCharacter()}
 * @method static mixed digitCharacter(mixed $value, ?string $message = null) Alias of {@see Guard::isDigitCharacter()}
 * @method static mixed lower(mixed $value, ?string $message = null) Alias of {@see Guard::isLowercase()}
 * @method static mixed lowercase(mixed $value, ?string $message = null) Alias of {@see Guard::isLowercase()}
 * @method static mixed graph(mixed $value, ?string $message = null) Alias of {@see Guard::isGraphicCharacter()}
 * @method static mixed graphicCharacter(mixed $value, ?string $message = null) Alias of {@see Guard::isGraphicCharacter()}
 * @method static mixed print(mixed $value, ?string $message = null) Alias of {@see Guard::isPrintableCharacter()}
 * @method static mixed printableCharacter(mixed $value, ?string $message = null) Alias of {@see Guard::isPrintableCharacter()}
 * @method static mixed punct(mixed $value, ?string $message = null) Alias of {@see Guard::isPunctuation()}
 * @method static mixed punctuationCharacter(mixed $value, ?string $message = null) Alias of {@see Guard::isPunctuation()}
 * @method static mixed space(mixed $value, ?string $message = null) Alias of {@see Guard::isWhiteSpace()}
 * @method static mixed whitespace(mixed $value, ?string $message = null) Alias of {@see Guard::isWhiteSpace()}
 * @method static mixed upper(mixed $value, ?string $message = null) Alias of {@see Guard::isUppercase()}
 * @method static mixed uppercase(mixed $value, ?string $message = null) Alias of {@see Guard::isUppercase()}
 * @method static mixed xdigit(mixed $value, ?string $message = null) Alias of {@see Guard::isHexadecimalDigit()}
 * @method static mixed hexadecimalDigit(mixed $value, ?string $message = null) Alias of {@see Guard::isHexadecimalDigit()}
 */
trait CtypeGuards
{
    /**
     * Validates if the given value value contains only alphanumeric characters
     * and returns it.
     *
     * The method checks if the given value contains only alphanumeric characters
     * using the `ctype_alnum` function. If the validation fails, it throws an
     * `InvalidGuardArgumentException` with a custom or default error message.
     *
     * @param  mixed  $value The input value to validate.
     * @param  string|null  $message The custom error message.
     *
     * @return mixed The input value if validation passes.
     *
     * @throws InvalidGuardArgumentException If the validation fails.
     *
     * @see Alias: {@see Guard::alnum()}
     * @see Alias: {@see Guard::alphanumeric()}
     */
    #[Alias(['alnum', 'alphanumeric'])]
    public static function isAlphanumeric(mixed $value, ?string $message = null): string
    {
        Guard::isString($value, $message);

        return !ctype_alnum($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected alphanumeric characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value consists of alphabetic characters only and returns it.
     *
     * This method validates if the provided value consists of only alphabetic characters
     * (letters). In case the validation fails, an {@see InvalidGuardArgumentException}
     * is thrown with a custom or default message indicating that the value provided
     * did not contain only alphabetic characters.
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message [optional] The custom error message.
     *
     * @return mixed The value if it consists of alphabetic characters only.
     *
     * @throws InvalidGuardArgumentException If the value contains non-alphabetic characters.
     *
     * @see Alias: {@see Guard::alpha()}
     * @see Alias: {@see Guard::alphabetic()}
     */
    #[Alias(['alpha', 'alphabetic'])]
    public static function isAlphabetic(mixed $value, ?string $message = null): string
    {
        Guard::isString($value, $message);

        return !ctype_alpha($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected alphabetic characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value contains only control characters and returns it.
     *
     * This method checks if the given value only contains control characters
     * as defined by the `ctype_cntrl()` function. If the value contains any
     * non-control characters, an {@see InvalidGuardArgumentException} will
     * be thrown.
     *
     * @param  mixed  $value The value to be verified.
     * @param  string|null  $message The custom error message to be thrown.
     *
     * @return mixed The original value if it contains only control characters.
     *
     * @throws InvalidGuardArgumentException If the value contains any
     * non-control characters.
     *
     * @see Alias: {@see Guard::cntrl()}
     * @see Alias: {@see Guard::controlCharacter()}
     */
    #[Alias(['cntrl', 'controlCharacter'])]
    public static function isControlCharacter(mixed $value, ?string $message = null): string
    {
        Guard::isString($value, $message);

        return !ctype_cntrl($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected control characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value consists of digits only and returns it.
     *
     * This method checks that the given value consists of digits only
     * using the `ctype_digit` function. If the value does not consist
     * of digits, it throws an {@see InvalidGuardArgumentException}.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The custom error message, if any.
     *
     * @return mixed The original value if it consists of digits only.
     *
     * @throws InvalidGuardArgumentException If the value does not consist of digits only.
     *
     * @see Alias: {@see Guard::digit()}
     * @see Alias: {@see Guard::digitCharacter()}
     */
    #[Alias(['digit', 'digitCharacter'])]
    public static function isDigitCharacter(mixed $value, ?string $message = null): string
    {
        Guard::isString($value, $message);

        return !ctype_digit($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected digits only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value consists of lowercase characters only
     * and returns it.
     *
     * If the value does not consist of lowercase characters only, it will
     * throw an instance of {@see InvalidGuardArgumentException}.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return mixed The given value if it consists of lowercase characters only.
     *
     * @throws InvalidGuardArgumentException If the given value does not consist of
     *                                       lowercase characters only.
     *
     * @see Alias: {@see Guard::lower()}
     * @see Alias: {@see Guard::lowercase()}
     */
    #[Alias(['lower', 'lowercase'])]
    public static function isLowercase(mixed $value, ?string $message = null): string
    {
        return !ctype_lower($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected lowercase characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value contains only printable characters except space
     * and returns it.
     *
     * The method checks if the value passed to it is of type string and only contains
     * printable characters except space using the `ctype_graph` function. If the
     * value doesn't match the criteria, it throws {@see InvalidGuardArgumentException}
     * with the provided or default error message.
     *
     * @throws InvalidGuardArgumentException
     *
     * @see Alias: {@see Guard::printable()}
     * @see Alias: {@see Guard::print()}
     */
    #[Alias(['graph', 'graphicCharacter'])]
    public static function isGraphicCharacter(mixed $value, ?string $message = null): string
    {
        return !ctype_graph($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected printable characters except space. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a printable character including space
     * and returns it.
     *
     * This method checks whether the input value is a printable character,
     * which includes all letters, digits, punctuation, and whitespace.
     *
     * If the input value is not a printable character, an exception of
     * type {@see InvalidGuardArgumentException} will be thrown with a
     * custom or default error message.
     *
     * @param  mixed  $value the input value to validate
     * @param  string|null  $message the custom error message
     *
     * @return mixed the input value if it is a printable character
     *
     * @throws InvalidGuardArgumentException if the input value is not a printable character
     *
     * @see Alias: {@see Guard::print()}
     * @see Alias: {@see Guard::printableCharacter()}
     */
    #[Alias(['print', 'printableCharacter'])]
    public static function isPrintableCharacter(mixed $value, ?string $message = null): string
    {
        return !ctype_print($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected printable characters including space. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is punctuation and returns it.
     *
     * This method checks if the provided value contains only
     * printable characters except letters and digits. If the
     * value is not punctuation, an exception is thrown.
     *
     * @param  mixed  $value The value to be checked.
     * @param  string|null  $message The custom error message.
     *
     * @return mixed The checked value if it is punctuation.
     *
     * @throws InvalidGuardArgumentException If the value is not punctuation.
     *
     * @see Alias: {@see Guard::punct()}
     * @see Alias: {@see Guard::punctuationCharacter()}
     */
    #[Alias(['punct', 'punctuationCharacter'])]
    public static function isPunctuation(mixed $value, ?string $message = null): string
    {
        return !ctype_punct($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected printable characters except letters and digits. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a whitespace character and returns it.
     *
     * The method will validate the given value if it contains only whitespace
     * characters, if it fails, it will throw an {@see InvalidGuardArgumentException}
     * with the custom or default error message.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The custom error message.
     *
     * @return mixed Returns the validated value if it passes the validation.
     *
     * @throws InvalidGuardArgumentException If the given value is not a whitespace character.
     *
     * @see Alias: {@see Guard::space()}
     * @see Alias: {@see Guard::whitespace()}
     */
    #[Alias(['space', 'whitespace'])]
    public static function isWhiteSpace(mixed $value, ?string $message = null): string
    {
        return !ctype_space($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected whitespace characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value contains only uppercase characters
     * and returns it.
     *
     * This method checks if the given value contains only uppercase
     * characters using the `ctype_upper()` function. If the
     * validation fails, an {@see InvalidGuardArgumentException} is
     * thrown with a default message or a custom message, if provided.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The custom exception message.
     *
     * @return mixed The value if it is valid.
     *
     * @throws InvalidGuardArgumentException If the validation fails.
     *
     * @see Alias: {@see Guard::upper()}
     * @see Alias: {@see Guard::uppercase()}
     */
    #[Alias(['upper', 'uppercase'])]
    public static function isUppercase(mixed $value, ?string $message = null): string
    {
        return !ctype_upper($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected uppercase characters only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is a hexadecimal digit and returns it.
     *
     * This method checks if the passed value contains only hexadecimal
     * digits (0-9, a-f, A-F). If not, an {@see InvalidGuardArgumentException}
     * will be thrown.
     *
     * @param  mixed  $value The value to be validated.
     * @param  string|null  $message Custom error message.
     *
     * @return mixed The input value if it's a hexadecimal digit.
     *
     * @throws InvalidGuardArgumentException If the input value is not a hexadecimal digit.
     *
     * @see Alias: {@see Guard::xdigit()}
     * @see Alias: {@see Guard::hexadecimalDigit()}
     */
    #[Alias(['xdigit', 'hexadecimalDigit'])]
    public static function isHexadecimalDigit(mixed $value, ?string $message = null): string
    {
        return !ctype_xdigit($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected hexadecimal digits only. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
