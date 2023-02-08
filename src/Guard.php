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

    public static function stringNotEmpty(mixed $value, ?string $message = null): string
    {
        self::string($value, $message);
        self::notEqualTo($value, '', $message);

        return $value;
    }

    public static function integer(mixed $value, ?string $message = null): int
    {
        if (!is_int($value)) {
            throw InvalidArgumentException::create($message ?:
                'Expected an integer. Got: '.get_debug_type($value)
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

    public static function notEqualTo(mixed $value, mixed $other, ?string $message = null): mixed
    {
        if ($value == $other) {
            throw InvalidArgumentException::create($message ?:
                'Expected a value different from: '.get_debug_type($value).
                '. Got: '.get_debug_type($other)
            );
        }

        return $value;
    }
}
