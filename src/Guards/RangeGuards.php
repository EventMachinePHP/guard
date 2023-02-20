<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating [replace] values.
 *
 * @method static mixed btw(mixed $value, mixed $min, mixed $max, ?string $message = null) Alias of {@see Guard::isBetween()}
 * @method static mixed between(mixed $value, mixed $min, mixed $max, ?string $message = null) Alias of {@see Guard::isBetween()}
 * @method static mixed wtn(mixed $value, mixed $min, mixed $max, ?string $message = null) Alias of {@see Guard::isWithin()}
 * @method static mixed within(mixed $value, mixed $min, mixed $max, ?string $message = null) Alias of {@see Guard::isWithin()}
 */
trait RangeGuards
{
    /**
     * Validates if the given value is between min and max and return it.
     *
     * This method checks if the value is equal to or greater than the
     * minimum value and equal to or less than the maximum value. If
     * the value is outside the range, an {@see InvalidGuardArgumentException}
     * will be thrown.
     *
     * @param  mixed  $value Value to be checked.
     * @param  mixed  $min The minimum value.
     * @param  mixed  $max The maximum value.
     * @param  string|null  $message Custom error message.
     *
     * @return mixed The original value.
     *
     * @throws InvalidGuardArgumentException If value is not between the min and max.
     *
     * @see Alias: Guard::btw()
     * @see Alias: Guard::between()
     */
    #[Alias(['btw', 'between'])]
    public static function isBetween(mixed $value, mixed $min, mixed $max, ?string $message = null): mixed
    {
        return $value <= $min || $value >= $max
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value between %s (%s) and %s (%s). Got: %s (%s)',
                values: [
                    self::valueToString($min),
                    self::valueToType($min),
                    self::valueToString($max),
                    self::valueToType($max),
                    self::valueToString(value: $value),
                    self::valueToType(value: $value),
                ],
            )
            : $value;
    }

    /**
     * Validates if the given value is within the bounds defined by min and max.
     *
     * This method checks if the `$value` is greater than `$min` and less than `$max`.
     * If the validation fails, an {@see InvalidGuardArgumentException} will be
     * thrown.
     *
     *
     *
     * @throws InvalidGuardArgumentException
     *
     * @see Alias: Guard::wtn()
     * @see Alias: Guard::within()
     */
    #[Alias(['wtn', 'within'])]
    public static function isWithin(mixed $value, mixed $min, mixed $max, ?string $message = null): mixed
    {
        return $value < $min || $value > $max
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value within the bounds of %s (%s) and %s (%s). Got: %s (%s)',
                values: [
                    self::valueToString($min),
                    self::valueToType($min),
                    self::valueToString($max),
                    self::valueToType($max),
                    self::valueToString(value: $value),
                    self::valueToType(value: $value),
                ],
            )
            : $value;
    }
}
