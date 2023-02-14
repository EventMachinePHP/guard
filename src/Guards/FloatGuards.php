<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_float;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains guards that check if a value is of type float.
 *
 * @method static float fl(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 * @method static float float(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 * @method static float is_float(mixed $value, ?string $message = null) Alias of {@see Guard::isFloat()}
 *
 * TODO: Consider guards for negative, positive float values?
 */
trait FloatGuards
{
    /**
     * Validates if the given value is a float and returns it.
     *
     * This method checks if the given value is a float and returns
     * the value if it's a float. If the value is not a float, an
     * {@see InvalidArgumentException} is thrown with a custom
     * message if provided or a default error message.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message The custom error message.
     *
     * @return float The validated float value.
     *
     * @throws InvalidArgumentException If the value is not a float.
     *
     * @see Alias: Guard::fl()
     * @see Alias: Guard::float()
     * @see Alias: Guard::is_float()
     */
    #[Alias(['fl', 'float', 'is_float'])]
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
