<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_callable;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating callable values.
 *
 * @method static callable c(mixed $value, ?string $message = null) Alias of {@see Guard::isCallable()}
 * @method static callable callable(mixed $value, ?string $message = null) Alias of {@see Guard::isCallable()}
 * @method static callable is_callable(mixed $value, ?string $message = null) Alias of {@see Guard::isCallable()}
 */
trait CallableGuards
{
    /**
     * Validates if the given value is callable and returns it.
     *
     * This function checks whether a value is callable. If the value is
     * not callable, it throws an `{@see InvalidGuardArgumentException}` with
     * a custom or default error message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message The error message to use.
     *
     * @return callable The callable value.
     *
     * @throws InvalidGuardArgumentException If the value is not callable.
     *
     * @see Alias: {@see Guard::c()}
     * @see Alias: {@see Guard::callable()}
     * @see Alias: {@see Guard::is_callable()}
     */
    #[Alias(['c', 'callable', 'is_callable'])]
    public static function isCallable(mixed $value, ?string $message = null): callable
    {
        return !is_callable($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a callable. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
