<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_callable;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating callable values.
 *
 * @method static callable c(mixed $value, ?string $message = null) @see Guard::isCallable()
 * @method static callable callable(mixed $value, ?string $message = null) @see Guard::isCallable()
 * @method static callable is_callable(mixed $value, ?string $message = null) @see Guard::isCallable()
 */
trait CallableGuards
{
    /**
     * Check if a value is callable and return it.
     *
     * This method is used to validate if the passed value is callable.
     * If the value is not callable, an `InvalidArgumentException` is thrown.
     *
     * @param  mixed  $value The value to be checked if it's callable. This could be a closure, a string containing the name of a function, or an object that implements the `__invoke` method.
     * @param  string|null  $message Custom error message to be thrown when the value is not callable. If this parameter is not provided, a default error message will be used.
     *
     * @return callable The value if it's callable.
     *
     * @throws InvalidArgumentException If the value is not callable. The error message will either be the custom message passed in the `$message` parameter or a default error message.
     *
     * @see Guard::c()
     * @see Guard::callable()
     * @see Guard::is_callable()
     */
    #[Alias(['c', 'callable', 'is_callable'])]
    public static function isCallable(mixed $value, ?string $message = null): callable
    {
        return !is_callable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a callable. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
