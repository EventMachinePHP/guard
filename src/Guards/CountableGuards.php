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
 * @method static Countable|array co(mixed $value, ?string $message = null) Alias of {@see Guard::isCountable()}
 * @method static Countable|array countable(mixed $value, ?string $message = null) Alias of {@see Guard::isCountable()}
 * @method static Countable|array is_countable(mixed $value, ?string $message = null) Alias of {@see Guard::isCountable()}
 */
trait CountableGuards
{
    /**
     * Validates if the given value is countable and returns ıt.
     *
     * This method checks if the provided value is either an instance
     * of the {@see \Countable} interface or an array.
     *
     * If the value is not countable, an {@see InvalidArgumentException}
     * is thrown with a default message indicating the expected
     * type and the received value and type. If a custom
     * message is provided, it will be used instead.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message A custom error message.
     *
     * @return Countable|array The countable value.
     *
     * @throws InvalidArgumentException If the value is not countable.
     *
     * @see Alias: Guard::co()
     * @see Alias: Guard::countable()
     * @see Alias: Guard::is_countable()
     */
    #[Alias(['co', 'countable', 'is_countable'])]
    public static function isCountable(mixed $value, ?string $message = null): Countable|array
    {
        return !is_countable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a countable value. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
