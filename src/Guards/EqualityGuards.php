<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating equality values.
 *
 * @method static mixed eq(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isEqualTo()}
 * @method static mixed equalTo(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isEqualTo()}
 * @method static mixed id(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isIdenticalTo()}
 * @method static mixed same(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isIdenticalTo()}
 * @method static mixed identical(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isIdenticalTo()}
 * @method static mixed identicalTo(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isIdenticalTo()}
 */
trait EqualityGuards
{
    /**
     * Validates if the given value is equal to the expected value
     * and returns it.
     *
     * If the value is not equal to the expected value, an exception
     * is thrown. The exception message can be custom or a default
     * message is used, which includes the expected value and the
     * received value.
     *
     * @param  mixed  $value The value to check.
     * @param  mixed  $expect The expected value.
     * @param  string|null  $message A custom message to use in the exception.
     *
     * @return mixed The value if it is equal to the expected value.
     *
     * @throws InvalidGuardArgumentException If the value is not equal to the expected value.
     *
     * @see Alias: Guard::eq()
     * @see Alias: Guard::equalTo()
     */
    #[Alias(['eq', 'equalTo'])]
    public static function isEqualTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value != $expect
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value), self::valueToString($expect), self::valueToType($expect)],
            )
            : $value;
    }

    /**
     * Verifies if the given value is identical to a specified value
     * and returns it.
     *
     * This method is used to check that a value is identical to a specified
     * value. If the value is not identical to the specified value, an
     * {@see InvalidGuardArgumentException} will be thrown.
     *
     * @param  mixed  $value     The value to be verified.
     * @param  mixed  $expect    The expected value.
     * @param  string|null  $message  Custom error message.
     *
     * @return mixed The value if it is identical to the specified value.
     *
     * @throws InvalidGuardArgumentException if the value is not identical to the specified value.
     *
     * @see Alias: Guard::id()
     * @see Alias: Guard::same()
     * @see Alias: Guard::identical()
     * @see Alias: Guard::identicalTo()
     *
     */
    #[Alias(['id', 'same', 'identical', 'identicalTo'])]
    public static function isIdenticalTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value !== $expect
            ? throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value identical to: %s (%s). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value), self::valueToString($expect), self::valueToType($expect)],
            )
            : $value;
    }
}
