<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use Countable;
use ArrayAccess;
use ReflectionClass;
use function is_array;
use function get_class;
use function is_object;
use function is_string;
use function is_callable;
use function is_resource;
use BadMethodCallException;
use function get_resource_type;
use EventMachinePHP\Guard\Guards\FloatGuards;
use EventMachinePHP\Guard\Guards\ScalarGuards;
use EventMachinePHP\Guard\Guards\StringGuards;
use EventMachinePHP\Guard\Guards\BooleanGuards;
use EventMachinePHP\Guard\Guards\IntegerGuards;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

class Guard
{
    use BooleanGuards;
    use FloatGuards;
    use IntegerGuards;
    use ScalarGuards;
    use StringGuards;

    // TODO: Core_c: Loop through interfaces, using instance of
    // TODO: Look for php aliases methods
    // TODO: standard_5: function is_ (Search)
    // TODO: Look for examples on php.net for native functions, use them in tests
    // TODO: * @see number_of() :alias:
    // TODO: Update type tests using IntegerTest cases

    // region Objects

    public static function object(mixed $value, ?string $message = null): object
    {
        return !is_object($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an object. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Resources

    public static function resource(mixed $value, ?string $type = null, ?string $message = null)
    {
        if (!is_resource($value)) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            );
        }

        if ($type !== null && get_resource_type($value) !== $type) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource of type: %s. Got: %s',
                values: [$type, get_resource_type($value)],
            );
        }

        return $value;
    }

    // endregion

    // region Callables

    public static function isCallable(mixed $value, ?string $message = null): callable
    {
        return !is_callable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a callable. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Arrays

    public static function isArray(mixed $value, ?string $message = null): array
    {
        return !is_array($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    public static function isArrayAccessible(mixed $value, ?string $message = null): array|ArrayAccess
    {
        return !is_array($value) && !($value instanceof ArrayAccess)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an array or an object implementing ArrayAccess. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Countables

    public static function isCountable(mixed $value, ?string $message = null): Countable|array
    {
        return !is_countable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a countable value. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Iterables

    public static function isIterable(mixed $value, ?string $message = null): iterable
    {
        return !is_iterable($value)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an iterable. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    // endregion

    // region Instances

    public static function isInstanceOf(mixed $value, string $class, ?string $message = null): object
    {
        return !($value instanceof $class)
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    public static function notInstanceOf(mixed $value, string $class, ?string $message = null): mixed
    {
        return $value instanceof $class
            ? throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a value not being an instance of %s. Got: %s (%s)',
                values: [$class, self::valueToString($value), self::valueToType($value)],
            )
            : $value;
    }

    public static function isInstanceOfAny(mixed $value, array $classes, ?string $message = null): object
    {
        foreach ($classes as $class) {
            if ($value instanceof $class) {
                return $value;
            }
        }

        return throw InvalidArgumentException::create(
            customMessage: $message,
            defaultMessage: 'Expected an instance of any of %s. Got: %s (%s)',
            values: [implode(', ', $classes), self::valueToString($value), self::valueToType($value)],
        );
    }

    // endregion

    // region Equality

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

    public static function valueToType(mixed $value): string
    {
        return get_debug_type($value);
    }

    // endregion
}
