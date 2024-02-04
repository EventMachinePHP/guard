<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\ExceptionMessage;
use function is_bool;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating boolean values.
 *
 * @method static bool b(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool bool(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool is_bool(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool boolean(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool t(mixed $value, ?string $message = null) Alias of {@see Guard::isTrue()}
 * @method static bool true(mixed $value, ?string $message = null) Alias of {@see Guard::isTrue()}
 * @method static bool f(mixed $value, ?string $message = null) Alias of {@see Guard::isFalse()}
 * @method static bool false(mixed $value, ?string $message = null) Alias of {@see Guard::isFalse()}
 */
trait BooleanGuards
{
    /**
     * Validates if the given value is a boolean and returns it.
     *
     * If the value is not a boolean, an {@see InvalidGuardArgumentException}
     * is thrown. The exception message can be customized by providing
     * the `$message` parameter.
     *
     * @param  mixed  $value  Value to validate.
     * @param  string|null  $message  Custom exception message.
     *
     * @return bool The validated boolean value.
     *
     * @throws InvalidGuardArgumentException If the value is not a boolean.
     *
     * @see Alias: {@see Guard::b()}
     * @see Alias: {@see Guard::bool()}
     * @see Alias: {@see Guard::is_bool()}
     * @see Alias: {@see Guard::boolean()}
     */
    #[Alias(['b', 'bool', 'is_bool', 'boolean'])]
    public static function isBoolean(mixed $value, ?string $message = null): bool
    {
        return !is_bool($value)
            ? throw InvalidGuardArgumentException::create(
                defaultMessage: ExceptionMessage::IsBoolean,
                customMessage: $message,
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is true and returns it.
     *
     * This method checks if the given value is equal to `true`.
     * If the value is not equal to `true`, it will throw an
     * {@see InvalidGuardArgumentException}. The custom error
     * message or the default error message will be
     * used depending on the availability of the
     * custom message.
     *
     * @param  mixed  $value  The value to validate.
     * @param  string|null  $message  [optional] The custom error message.
     *
     * @return bool Returns `true` if the value is equal to `true`.
     *
     * @see Alias: {@see Guard::t()}
     * @see Alias: {@see Guard::true()}
     */
    #[Alias(['t', 'true'])]
    public static function isTrue(mixed $value, ?string $message = null): bool
    {
        return $value !== true
            ? throw InvalidGuardArgumentException::create(
                defaultMessage: 'Expected a value to be true. Got: %s (%s)',
                customMessage: $message,
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : true;
    }

    /**
     * Validates if the given value is false and returns it.
     *
     * This method checks if the given value is equal to `false`.
     * If the value is not equal to `false`, it will throw an
     * {@see InvalidGuardArgumentException}. The custom error
     * message or the default error message will be
     * used depending on the availability of the
     * custom message.
     *
     * @param  mixed  $value  The value to validate.
     * @param  string|null  $message  [optional] The custom error message.
     *
     * @return bool Returns `true` if the value is equal to `true`.
     *
     * @see Alias: {@see Guard::f()}
     * @see Alias: {@see Guard::false()}
     */
    #[Alias(['f', 'false'])]
    public static function isFalse(mixed $value, ?string $message = null): bool
    {
        return $value !== false
            ? throw InvalidGuardArgumentException::create(
                defaultMessage: 'Expected a value to be false. Got: %s (%s)',
                customMessage: $message,
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : false;
    }
}
