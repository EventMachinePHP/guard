<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use ReflectionClass;
use function is_array;
use function get_class;
use function is_object;
use function is_string;
use function is_resource;
use BadMethodCallException;
use EventMachinePHP\Guard\Guards\ArrayGuards;
use EventMachinePHP\Guard\Guards\FloatGuards;
use EventMachinePHP\Guard\Guards\ObjectGuards;
use EventMachinePHP\Guard\Guards\ScalarGuards;
use EventMachinePHP\Guard\Guards\StringGuards;
use EventMachinePHP\Guard\Guards\BooleanGuards;
use EventMachinePHP\Guard\Guards\IntegerGuards;
use EventMachinePHP\Guard\Guards\CallableGuards;
use EventMachinePHP\Guard\Guards\InstanceGuards;
use EventMachinePHP\Guard\Guards\IterableGuards;
use EventMachinePHP\Guard\Guards\ResourceGuards;
use EventMachinePHP\Guard\Guards\CountableGuards;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

class Guard
{
    use ArrayGuards;
    use BooleanGuards;
    use CallableGuards;
    use CountableGuards;
    use FloatGuards;
    use InstanceGuards;
    use IntegerGuards;
    use IterableGuards;
    use ObjectGuards;
    use ResourceGuards;
    use ScalarGuards;
    use StringGuards;

    // TODO: Core_c: Loop through interfaces, using instance of
    // TODO: Look for php aliases methods
    // TODO: standard_5: function is_ (Search)
    // TODO: Look for examples on php.net for native functions, use them in tests
    // TODO: * @see number_of() :alias:
    // TODO: Update type tests using IntegerTest cases

    // region Equality

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
     */
    public static function equalTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value != $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value), self::valueToString($expect), self::valueToType($expect)],
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
     */
    public static function notEqualTo(mixed $value, mixed $expect, ?string $message = null): mixed
    {
        return $value == $expect
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value different from: %s (%s). Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value), self::valueToString($expect), self::valueToType($expect)],
            )
            : $value;
    }

    // endregion

    // region Comparisons

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
     */
    public static function greaterThan(mixed $value, mixed $limit, ?string $message = null): mixed
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
     */
    public static function greaterThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
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
     */
    public static function lessThan(mixed $value, mixed $limit, ?string $message = null): mixed
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
     */
    public static function lessThanOrEqual(mixed $value, mixed $limit, ?string $message = null): mixed
    {
        return $value > $limit
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value less than or equal to: %s (%s). Got: %s (%s)',
                values: [self::valueToString($limit), self::valueToType($limit), self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Aliases

    /**
     * Handle calls to static alias methods of the `Guard` class by
     * resolving their corresponding defined method based on the
     * method attributes.
     *
     * @param  string  $calledAlias  The name of the alias.
     * @param  array  $arguments    The arguments passed to the alias.
     *
     * @return mixed The result of the corresponding defined method.
     *
     * @throws BadMethodCallException if the called alias does not have
     * a corresponding defined method.
     */
    public static function __callStatic(string $calledAlias, array $arguments)
    {
        static $methodAliases = null;

        if ($methodAliases === null) {
            $methodAliases = [];
            $class         = new ReflectionClass(__CLASS__);
            foreach ($class->getMethods() as $method) {
                foreach ($method->getAttributes() as $attribute) {
                    $attributeArguments = $attribute->getArguments()[0];
                    $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];
                    foreach ($aliasMethodNames as $alias) {
                        $methodAliases[$alias] = $method->getName();
                    }
                }
            }
        }

        if (array_key_exists($calledAlias, $methodAliases)) {
            return call_user_func([self::class, $methodAliases[$calledAlias]], ...$arguments);
        }

        throw new BadMethodCallException(sprintf('Method "%s" does not exist.', $calledAlias));
    }

    // endregion

    // region Helpers

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

    // endregion
}
