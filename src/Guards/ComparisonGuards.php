<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating compared values.
 *
 * @method static mixed gt(mixed $value, mixed $limit, ?string $message = null) @see Guard::isGreaterThan()
 * @method static mixed greaterThan(mixed $value, mixed $limit, ?string $message = null) @see Guard::isGreaterThan()
 * @method static mixed gte(mixed $value, mixed $limit, ?string $message = null) @see Guard::isGreaterThanOrEqual()
 * @method static mixed greaterThanOrEqual(mixed $value, mixed $limit, ?string $message = null) @see Guard::isGreaterThanOrEqual()
 * @method static mixed lt(mixed $value, mixed $limit, ?string $message = null) @see Guard::isLessThan()
 * @method static mixed lessThan(mixed $value, mixed $limit, ?string $message = null) @see Guard::isLessThan()
 * @method static mixed lte(mixed $value, mixed $limit, ?string $message = null) @see Guard::isLessThanOrEqual()
 * @method static mixed lessThanOrEqual(mixed $value, mixed $limit, ?string $message = null) @see Guard::isLessThanOrEqual()
 */
trait ComparisonGuards
{
    /**
     * Validates if the given value is greater than the specified limit
     * and returns it.
     *
     * If the given value is less than or equal to the limit, an
     * {@see InvalidArgumentException} will be thrown with a
     * default or custom message.
     *
     * @param  mixed  $value The value to validate.
     * @param  mixed  $limit The limit to compare the value against.
     * @param  string|null  $message The exception message to throw.
     *
     * @return mixed The original value.
     *
     * @throws InvalidArgumentException If the value is less than or equal to the limit.
     *
     * @see Guard::gt()
     * @see Guard::greaterThan()
     */
    #[Alias(['gt', 'greaterThan'])]
    public static function isGreaterThan(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value <= $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value greater than: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), self::valueToType($limit), self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Validates if the value is greater than or equal to the specified limit
     * and returns it.
     *
     * @param  mixed  $value The value to check
     * @param  mixed  $limit The limit to compare to
     * @param  string|null  $message The custom error message
     *
     * @return mixed The input value
     *
     *@throws InvalidArgumentException If the value is not greater than or equal to the limit
     *
     * @see Guard::gte()
     * @see Guard::greaterThanOrEqual()
     */
    #[Alias(['gte', 'greaterThanOrEqual'])]
    public static function isGreaterThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value < $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value greater than or equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), self::valueToType($limit), self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Validates if the value is less than a limit and returns it.
     *
     * Throws an {@see InvalidArgumentException} if the value is
     * greater than or equal to the limit.
     *
     * @param  mixed  $value The value to validate.
     * @param  mixed  $limit The limit to compare with.
     * @param  string|null  $message The error message to use if the validation fails.
     *
     * @return mixed The value if validation is successful.
     *
     * @throws InvalidArgumentException If the value is greater than or equal to the limit.
     *
     * @see Guard::lt()
     * @see Guard::lessThan()
     */
    #[Alias(['lt', 'lessThan'])]
    public static function isLessThan(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value >= $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value less than: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), self::valueToType($limit), self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    /**
     * Validates if the given value is less than or equal to the given limit
     * and returns it.
     *
     * Throws an exception if the value is greater than the limit.
     * The exception message can be customized by passing a
     * string to the optional $message parameter. If the
     * $message parameter is not provided, a default
     * message will be used.
     *
     * @param  mixed  $value The value to be checked
     * @param  mixed  $limit The limit to check against
     * @param  string|null  $message Custom exception message
     *
     * @return mixed The value if it is less than or equal to the limit
     *
     *@throws InvalidArgumentException If the value is greater than the limit
     *
     * @see Guard::lte()
     * @see Guard::lessThanOrEqual()
     */
    #[Alias(['lte', 'lessThanOrEqual'])]
    public static function isLessThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value > $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value less than or equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), self::valueToType($limit), self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }
}
