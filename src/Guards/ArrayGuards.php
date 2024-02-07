<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use ArrayAccess;

use function is_array;

use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating array values.
 *
 * @method static array a(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static array array(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static array is_array(mixed $value, ?string $message = null) Alias of {@see Guard::isArray()}
 * @method static ArrayAccess|array aa(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 * @method static ArrayAccess|array array_accessible(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 * @method static ArrayAccess|array is_array_accessible(mixed $value, ?string $message = null) Alias of {@see Guard::isArrayAccessible()}
 * @method static iterable us(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueStrictValues()}
 * @method static iterable unique_strict(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueStrictValues()}
 * @method static iterable unique_strict_values(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueStrictValues()}
 * @method static iterable ul(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueLooseValues()}
 * @method static iterable unique_loose(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueLooseValues()}
 * @method static iterable unique_loose_values(iterable $values, ?string $message = null) Alias of {@see Guard::hasUniqueLooseValues()}
 */
trait ArrayGuards
{
    /**
     * Validates if the given value is an array and returns it.
     *
     * Throws an {@see InvalidGuardArgumentException} if the value
     * is not an array.
     *
     * @param mixed $value The value to validate.
     * @param string|null $message Custom error message.
     *
     * @return array The value as an array.
     *
     * @throws InvalidGuardArgumentException If the value is not an array.
     *
     * @see Alias: {@see Guard::a()}
     * @see Alias: {@see Guard::array()}
     * @see Alias: {@see Guard::is_array()}
     */
    #[Alias(['a', 'array', 'is_array'])]
    public static function isArray(mixed $value, ?string $message = null): array
    {
        return is_array($value)
            ? $value
            : throw InvalidGuardArgumentException::create(
                defaultMessage: ExceptionMessage::IsArray,
                customMessage: $message,
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            );
    }

    /**
     * Validates if the given value is either an array or implements
     * {@see ArrayAccess} and returns it.
     *
     * This method checks if the given value is either an array or
     * an object that implements the {@see ArrayAccess} interface.
     * If the value is not an array or {@see ArrayAccess}, it
     * throws an {@see InvalidGuardArgumentException} with a
     * custom or default error message.
     *
     * @param mixed $value The value to be checked.
     * @param string|null $message Optional custom error message.
     *
     * @return array|ArrayAccess The value if it is either an array or implements ArrayAccess.
     *
     * @throws InvalidGuardArgumentException If the value is not an array or ArrayAccess.
     *
     * @see Alias: {@see Guard::aa()}
     * @see Alias: {@see Guard::array_accessible()}
     * @see Alias: {@see Guard::is_array_accessible()}
     */
    #[Alias(['aa', 'array_accessible', 'is_array_accessible'])]
    public static function isArrayAccessible(mixed $value, ?string $message = null): array|ArrayAccess
    {
        return !(is_array($value) || $value instanceof ArrayAccess)
            ? throw InvalidGuardArgumentException::create(
                defaultMessage: ExceptionMessage::IsArrayAccessible,
                customMessage: $message,
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            )
            : $value;
    }

    /**
     * Validates if the given values in the iterable are unique
     * using strict comparison and return them.
     *
     * Given an iterable, this method will loop over the values
     * and perform a strict comparison between each pair of
     * values to ensure that no duplicate values exist. If
     * a duplicate is found, an exception will be thrown.
     *
     * @param iterable $values the iterable to check for unique values
     * @param string|null $message optional error message to use instead of the default
     *
     * @return iterable returns the original iterable if all values are unique
     *
     * @see Alias: {@see Guard::us()}
     * @see Alias: {@see Guard::unique_strict()}
     * @see Alias: {@see Guard::unique_strict_values()}
     */
    #[Alias(['us', 'unique_strict', 'unique_strict_values'])]
    public static function hasUniqueStrictValues(iterable $values, ?string $message = null): iterable
    {
        foreach ($values as $value1) {
            $count = 0;
            foreach ($values as $value2) {
                if ($value1 === $value2) {
                    $count++;
                }
            }

            if ($count > 1) {
                throw InvalidGuardArgumentException::create(
                    defaultMessage: ExceptionMessage::HasUniqueStrictValues, // TODO: ?
                    customMessage: $message,
                    values: []
                );
            }
        }

        return $values;
    }

    /**
     * Validates if the given values in the iterable are unique
     * using loose comparison and return them.
     *
     * Given an iterable, this method will loop over the values
     * and perform a loose comparison between each pair of
     * values to ensure that no duplicate values exist. If
     * a duplicate is found, an exception will be thrown.
     *
     * @param iterable $values the iterable to check for unique values
     * @param string|null $message optional error message to use instead of the default
     *
     * @return iterable returns the original iterable if all values are unique
     *
     * @see Alias: {@see Guard::ul()}
     * @see Alias: {@see Guard::unique_loose()}
     * @see Alias: {@see Guard::unique_loose_values()}
     */
    #[Alias(['ul', 'unique_loose', 'unique_loose_values'])]
    public static function hasUniqueLooseValues(iterable $values, ?string $message = null): iterable
    {
        foreach ($values as $value1) {
            $count = 0;
            foreach ($values as $value2) {
                if ($value1 == $value2) {
                    $count++;
                }
            }

            if ($count > 1) {
                throw InvalidGuardArgumentException::create(
                    defaultMessage: ExceptionMessage::HasUniqueLooseValues,
                    customMessage: $message,
                    values: []
                );
            }
        }

        return $values;
    }
}
