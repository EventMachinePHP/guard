<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function class_exists;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating class values.
 *
 * @method static string cl(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 * @method static string class(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 * @method static string class_exists(mixed $value, ?string $message = null) Alias of {@see Guard::isClassExists()}
 */
trait ClassGuards
{
    /**
     * Validates if the given input is an existing class name and returns it.
     *
     * This method checks if the input string is a valid class name and
     * class exists in the current environment. If the input is not a
     * valid class name or the class does not exist, an
     * {@see InvalidArgumentException} is thrown.
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
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an existing class name. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
