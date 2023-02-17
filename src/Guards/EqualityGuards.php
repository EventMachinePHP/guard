<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating equality values.
 *
 * @method static mixed eq(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isEqualTo()}
 * @method static mixed equalTo(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::isEqualTo()}
 * @method static mixed neq(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::IsNotEqualTo()}
 * @method static mixed notEq(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::IsNotEqualTo()}
 * @method static mixed notEqualTo(mixed $value, mixed $expect, ?string $message = null) Alias of {@see Guard::IsNotEqualTo()}
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
     * @throws InvalidArgumentException If the value is not equal to the expected value.
     *
     * @see Alias: Guard::eq()
     * @see Alias: Guard::equalTo()
     */
    #[Alias(['eq', 'equalTo'])]
    public static function isEqualTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value != $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value), self::valueToString($expect), self::valueToType($expect)],
            )
            : $value;
    }

    /**
     * Validates if the given value is not equal to the expected value and returns it.
     *
     * Throws an {@see InvalidArgumentException} if the value is equal to the expected
     * value. The exception message can be customized through the `$message` parameter
     * or a default message will be used if not provided.
     *
     * @param  mixed  $value     The value to be validated.
     * @param  mixed  $expect    The expected value.
     * @param  string|null  $message  Optional custom error message.
     *
     * @return mixed The original value if validation passes.
     *
     * @throws InvalidArgumentException If the value is equal to the expected value.
     *
     * @see Alias: Guard::neq()
     * @see Alias: Guard::notEq()
     * @see Alias: Guard::notEqualTo()
     *
     * TODO: Consider to moving NotGuards?
     */
    #[Alias(['neq', 'notEq', 'notEqualTo'])]
    public static function IsNotEqualTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value == $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value different from: %s (%s). Got: %s (%s)',
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
     * {@see InvalidArgumentException} will be thrown.
     *
     * @param  mixed  $value     The value to be verified.
     * @param  mixed  $expect    The expected value.
     * @param  string|null  $message  Custom error message.
     *
     * @return mixed The value if it is identical to the specified value.
     *
     * @throws InvalidArgumentException if the value is not identical to the specified value.
     *
     * @see Alias: Guard::id()
     * @see Alias: Guard::same()
     * @see Alias: Guard::identical()
     * @see Alias: Guard::identicalTo()
     *
     * TODO: Consider not()->identicalTo()
     */
    #[Alias(['id', 'same', 'identical', 'identicalTo'])]
    public static function isIdenticalTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value !== $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value identical to: %s (%s). Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value), self::valueToString($expect), self::valueToType($expect)],
            )
            : $value;
    }
}
