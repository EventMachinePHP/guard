<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_callable;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating callable values.
 *
 * @method static callable is_callable(mixed $value, ?string $message = null) @see Guard::isCallable()
 */
trait CallableGuards
{
    /**
     * @see Guard::is_callable()
     */
    #[Alias(['is_callable'])]
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
