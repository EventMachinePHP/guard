<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_scalar;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

trait ScalarGuards
{
    /**
     * Validate if the given value is a scalar value.
     *
     * A scalar value is either a string, an integer, a float, or a boolean.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message Optional custom message for the exception.
     *
     * @return string|int|float|bool The validated scalar value.
     *
     * @throws InvalidArgumentException if the given value is not a scalar value.
     */
    #[Alias(['is_scalar', 'scalar', 'sc'])]
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
