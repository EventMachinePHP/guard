<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating empty values.
 *
 * @method static mixed ie(mixed $value, ?string $message = null) Alias of {@see Guard::isEmpty()}
 * @method static mixed empty(mixed $value, ?string $message = null) Alias of {@see Guard::isEmpty()}
 */
trait EmptyGuards
{
    /**
     * Validates if the given value is empty and returns it.
     *
     * The value will be considered empty if it is null, false, 0, 0.0, '0', '', [].
     *
     * @param  mixed  $value The value to check.
     * @param  string|null  $message The error message to use if the value is not empty.
     *
     * @return mixed The given value if it is empty.
     *
     * @throws InvalidGuardArgumentException If the value is not empty.
     *
     * @see Alias: Guard::ie()
     * @see Alias: Guard::empty()
     */
    #[Alias(['ie', 'empty'])]
    public static function isEmpty(mixed $value, ?string $message = null): mixed
    {
        return !empty($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an empty value. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
