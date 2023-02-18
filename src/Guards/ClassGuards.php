<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function class_exists;
use function is_subclass_of;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating class values.
 *
 * @method static string cl(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 * @method static string class(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 * @method static string class_exists(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 * @method static object|string sub(object|string $value, object|string $parentClass, ?string $message = null) Alias of {@see Guard::isSubClassOf()}
 * @method static object|string subclass_of(object|string $value, object|string $parentClass, ?string $message = null) Alias of {@see Guard::isSubClassOf()}
 */
trait ClassGuards
{
    /**
     * Validates if the given input is an existing class name and returns it.
     *
     * This method checks if the input string is a valid class name and
     * class exists in the current environment. If the input is not a
     * valid class name or the class does not exist, an
     * {@see InvalidGuardArgumentException} is thrown.
     *
     * @param  mixed  $value    The input value to validate.
     * @param  string|null  $message  Custom error message to use.
     *
     * @return string           The input value if it is a valid existing class name.
     *
     * @see Alias: Guard::cl()
     * @see Alias: Guard::class()
     * @see Alias: Guard::class_exists()
     */
    #[Alias(['cl', 'class', 'class_exists'])]
    public static function isClassExists(mixed $value, ?string $message = null): string
    {
        Guard::isString($value);

        return (!class_exists($value))
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an existing class name. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given `$value` is a subclass of `$parentClass`
     * and returns it.
     *
     * If `$value` is an object, it will be converted to its class name.
     * If `$parentClass` is an object, it will be converted to its
     * class name.
     *
     * If `$value` is not a subclass of `$parentClass`, an
     * {@see InvalidGuardArgumentException} will be thrown with
     * either the `$message` or a default message.
     *
     * @param  string|object  $value      - The value to check
     * @param  string|object  $parentClass - The class to check against
     * @param  string|null  $message      - The custom error message
     *
     * @return string|object - The original `$value`
     *
     * @throws InvalidGuardArgumentException if `$value` is not a subclass of `$parentClass`
     *
     * @see Alias: Guard::sub()
     * @see Alias: Guard::subclass_of()
     */
    #[Alias(['sub', 'subclass_of'])]
    public static function isSubClassOf(string|object $value, string|object $parentClass, ?string $message = null): string|object
    {
        $value       = is_object($value) ? $value::class : $value;
        $parentClass = is_object($parentClass) ? $parentClass::class : $parentClass;

        return (!is_subclass_of($value, $parentClass))
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a subclass of %s. Got: %s (%s)',
                values: [$parentClass, self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }
}
