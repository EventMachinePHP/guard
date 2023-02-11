<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_float;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains guards that check if a value is of type float.
 *
 * @method static float f(mixed $value, ?string $message = null) @see Guard::isFloat()
 * @method static float float(mixed $value, ?string $message = null) @see Guard::isFloat()
 * @method static float is_float(mixed $value, ?string $message = null) @see Guard::isFloat()
 */
trait FloatGuards
{
    /**
     * Checks if the given value is a float.
     *
     * This method is used to ensure that the input value is a float.
     * If the value is not a float, an `InvalidArgumentException`
     * will be thrown.
     *
     * The exception message can include a custom message (if provided)
     * or a default message indicating that a float was expected,
     * and includes a string representation of the actual value
     * received.
     *
     * @param  mixed  $value The value to check
     * @param  string|null  $message [optional] A custom message to use in the exception, if thrown
     *
     * @return float The given value, if it is a float
     *
     * @throws InvalidArgumentException If the value is not a float
     */
    #[Alias(['is_float', 'float', 'f'])]
    public static function isFloat(mixed $value, ?string $message = null): float
    {
        return !is_float($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a float. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
