<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_scalar;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains guards that check if a value is a scalar value.
 *
 * A scalar value is either a string, an integer, a float, or a boolean.
 *
 * @method static string|int|float|bool sc(mixed $value, ?string $message = null) @see Guard::isScalar()
 * @method static string|int|float|bool scalar(mixed $value, ?string $message = null) @see Guard::isScalar()
 * @method static string|int|float|bool is_scalar(mixed $value, ?string $message = null) @see Guard::isScalar()
 */
trait ScalarGuards
{
    /**
     * Validates if the given value is a scalar value (string, int, float, bool)
     * and returns it.
     *
     * If the given value is not a scalar value, an {@see InvalidArgumentException}
     * will be thrown with a custom or default error message.
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message The custom error message.
     *
     * @return string|int|float|bool The input value if it's a scalar value.
     *
     * @throws InvalidArgumentException If the value is not a scalar value.
     *
     * @see Guard::sc()
     * @see Guard::scalar()
     * @see Guard::is_scalar()
     */
    #[Alias(['sc', 'scalar', 'is_scalar'])]
    public static function isScalar(mixed $value, ?string $message = null): string|int|float|bool
    {
        return !is_scalar($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a scalar value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
