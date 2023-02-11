<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_bool;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

trait BooleanGuards
{
    public static function isBoolean(mixed $value, ?string $message = null): bool
    {
        return !is_bool($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a boolean value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
