<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_iterable;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating iterable values.
 *
 * @method static iterable it(mixed $value, ?string $message = null) @see Guard::isIterable()
 * @method static iterable iterable(mixed $value, ?string $message = null) @see Guard::isIterable()
 * @method static iterable is_iterable(mixed $value, ?string $message = null) @see Guard::isIterable()
 */
trait IterableGuards
{
    /**
     * Check if a value is iterable and return it.
     * A value is considered iterable if it's an
     * array or an object that implements the
     * `Traversable` interface.
     *
     * @param  mixed  $value The value to be checked if it's iterable.
     * @param  string|null  $message Custom error message to be thrown when the value is not iterable.
     *
     * @return iterable The value if it's iterable.
     *
     * @throws InvalidArgumentException If the value is not iterable. The exception message includes the type and string representation of the value.
     *
     * @see Guard::it()
     * @see Guard::iterable()
     * @see Guard::is_iterable()
     */
    #[Alias(['it', 'iterable', 'is_iterable'])]
    public static function isIterable(mixed $value, ?string $message = null): iterable
    {
        return !is_iterable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an iterable. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
