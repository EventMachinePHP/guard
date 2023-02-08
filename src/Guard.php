<?php

namespace EventMachinePHP\Data;

use function is_string;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

class Guard
{
    public static function string(mixed $value, ?string $message = null): string
    {
        if (!is_string($value)) {
            throw InvalidArgumentException::create($message ?:
                'Expected a string. Got: '.get_debug_type($value)
            );
        }

        return $value;
    }
}
