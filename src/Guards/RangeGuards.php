<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

trait RangeGuards
{
    public static function rangeBetween(mixed $value, mixed $min, mixed $max, ?string $message = null): mixed
    {
        return $value < $min || $value > $max
            ? throw InvalidArgumentException::create(
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

    public static function rangeWithin(mixed $value, mixed $min, mixed $max, ?string $message = null): mixed
    {
        return $value <= $min || $value >= $max
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value within %s (%s) and %s (%s). Got: %s (%s)',
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
