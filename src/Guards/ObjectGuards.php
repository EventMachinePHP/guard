<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_object;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains guards that check if a value is of type object.
 *
 * @method static object o(mixed $value, ?string $message = null) Alias of {@see Guard::isObject()}
 * @method static object object(mixed $value, ?string $message = null) Alias of {@see Guard::isObject()}
 * @method static object is_object(mixed $value, ?string $message = null) Alias of {@see Guard::isObject()}
 */
trait ObjectGuards
{
    /**
     * Validates if the given value is an object and returns it.
     *
     * If the given value is not an object, an {@see InvalidGuardArgumentException}
     * will be thrown. The exception message can be customized by providing a
     * custom message as an optional second argument.
     *
     * @param  mixed  $value The value to validate.
     * @param  string|null  $message Custom exception message.
     *
     * @return object The original value if it is an object.
     *
     * @throws InvalidGuardArgumentException If the value is not an object.
     *
     * @see Alias: {@see Guard::o()}
     * @see Alias: {@see Guard::object()}
     * @see Alias: {@see Guard::is_object()}
     */
    #[Alias(['o', 'object', 'is_object'])]
    public static function isObject(mixed $value, ?string $message = null): object
    {
        return !is_object($value)
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an object. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
