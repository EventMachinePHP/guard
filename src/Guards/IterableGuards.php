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
     * Validates if the given value is iterable and returns it.
     *
     * If the value is not iterable, the method throws an
     * {@see InvalidArgumentException}
     *
     * @param  mixed  $value The value to be checked.
     * @param  string|null  $message The custom exception message.
     *
     * @return iterable The iterable value if it is iterable.
     *
     * @throws InvalidArgumentException If the value is not iterable.
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
