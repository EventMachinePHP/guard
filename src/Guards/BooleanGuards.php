<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_bool;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating boolean values.
 *
 * @method static bool b(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool bool(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool is_bool(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 * @method static bool boolean(mixed $value, ?string $message = null) Alias of {@see Guard::isBoolean()}
 */
trait BooleanGuards
{
    /**
     * Validates if the given value is a boolean and returns it.
     *
     * If the value is not a boolean, an {@see InvalidArgumentException}
     * is thrown. The exception message can be customized by providing
     * the `$message` parameter.
     *
     * @param  mixed  $value Value to validate.
     * @param  string|null  $message Custom exception message.
     *
     * @return bool The validated boolean value.
     *
     * @throws InvalidArgumentException If the value is not a boolean.
     *
     * @see Alias: Guard::b()
     * @see Alias: Guard::bool()
     * @see Alias: Guard::is_bool()
     * @see Alias: Guard::boolean()
     */
    #[Alias(['b', 'bool', 'is_bool', 'boolean'])]
    public static function isBoolean(mixed $value, ?string $message = null): bool
    {
        return !is_bool($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a boolean value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
