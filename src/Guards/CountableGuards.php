<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use Countable;
use function is_countable;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating countable values.
 *
 * @method static Countable|array co(mixed $value, ?string $message = null) @see Guard::isCountable()
 * @method static Countable|array countable(mixed $value, ?string $message = null) @see Guard::isCountable()
 * @method static Countable|array is_countable(mixed $value, ?string $message = null) @see Guard::isCountable()
 */
trait CountableGuards
{
    /**
     * Check if a value is countable and return it.
     *
     * A value is considered countable if it's either an array
     * or an object that implements the `Countable` interface.
     *
     * @param  mixed  $value The value to be checked if it's countable.
     * @param  string|null  $message Custom error message to be thrown when the value is not countable.
     *
     * @return Countable|array The value if it's countable.
     *
     * @throws InvalidArgumentException If the value is not countable. The exception message includes the type and string representation of the value.
     *
     * @see Guard::co()
     * @see Guard::countable()
     * @see Guard::is_countable()
     */
    #[Alias(['co', 'countable', 'is_countable'])]
    public static function isCountable(mixed $value, ?string $message = null): Countable|array
    {
        return !is_countable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a countable value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
