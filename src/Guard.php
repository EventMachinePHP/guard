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
    public static function equalTo(mixed $value, mixed $other, ?string $message = null): mixed
    {
        if ($value != $other) {
            throw InvalidArgumentException::create($message ?:
                'Expected a value equalTo to: '.get_debug_type($value).
                '. Got: '.get_debug_type($other)
            );
        }

        return $value;
    }
}
