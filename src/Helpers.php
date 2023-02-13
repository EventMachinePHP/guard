<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

trait Helpers
{
    /**
     * Converts a value to its string representation.
     *
     * Returns the string representation of the value. For `null` it returns
     * the string "null". For boolean values, it returns "true" or "false".
     * For arrays, it returns the string "array". For objects, it returns
     * the name of its class. For resources, it returns the string
     * "resource". For strings, it returns the string surrounded
     * by double quotes. For any other value, it returns the
     * result of casting the value to string.
     */
    public static function valueToString(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_object($value)) {
            return get_class($value);
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (is_string($value)) {
            return '"'.$value.'"';
        }

        return (string) $value;
    }

    /**
     * Converts a value to its type name.
     *
     * Returns the type name of the provided value using the
     * {@see get_debug_type()} function.
     *
     * @param  mixed  $value The value to convert to a type name.
     *
     * @return string The type name of the provided value.
     */
    public static function valueToType(mixed $value): string
    {
        return get_debug_type($value);
    }
}
