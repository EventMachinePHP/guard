<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

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
     * {@see InvalidGuardArgumentException} if it's not.
     *
     * @param  mixed  $value The value to verify.
     * @param  string|null  $message The exception message to throw.
     *
     * @return mixed The value if it's `null`.
     *
     * @throws InvalidGuardArgumentException If the value is not `null`.
     *
     * @see Alias: {@see Guard::n()}
     * @see Alias: {@see Guard::null()}
     */
    #[Alias(['n', 'null'])]
    public static function isNull(mixed $value, ?string $message = null): mixed
    {
        return $value !== null
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected null. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
