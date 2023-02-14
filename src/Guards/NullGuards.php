<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating null values.
 *
 * @method static mixed n(mixed $value, ?string $message = null) Alias of {@see Guard::isNull()}
 * @method static mixed null(mixed $value, ?string $message = null) Alias of {@see Guard::isNull()}
 */
trait NullGuards
{
    /**
     * Validates if the given value  is `null` and returns it.
     *
     * This method verifies that a value is `null` and throws an
     * {@see InvalidArgumentException} if it's not.
     *
     * @param  mixed  $value The value to verify.
     * @param  string|null  $message The exception message to throw.
     *
     * @return mixed The value if it's `null`.
     *
     * @throws InvalidArgumentException If the value is not `null`.
     *
     * @see Alias: Guard::n()
     * @see Alias: Guard::null()
     */
    #[Alias(['n', 'null'])]
    public static function isNull(mixed $value, ?string $message = null): mixed
    {
        return $value !== null
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected null. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
