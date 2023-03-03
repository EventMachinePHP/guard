<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use ReflectionClass;
use function is_array;
use BadMethodCallException;
use EventMachinePHP\Guard\Guards\NullGuards;
use EventMachinePHP\Guard\Guards\ArrayGuards;
use EventMachinePHP\Guard\Guards\ClassGuards;
use EventMachinePHP\Guard\Guards\CtypeGuards;
use EventMachinePHP\Guard\Guards\EmptyGuards;
use EventMachinePHP\Guard\Guards\RangeGuards;
use EventMachinePHP\Guard\Guards\ObjectGuards;
use EventMachinePHP\Guard\Guards\ScalarGuards;
use EventMachinePHP\Guard\Guards\StringGuards;
use EventMachinePHP\Guard\Guards\BooleanGuards;
use EventMachinePHP\Guard\Guards\NumericGuards;
use EventMachinePHP\Guard\Guards\CallableGuards;
use EventMachinePHP\Guard\Guards\EqualityGuards;
use EventMachinePHP\Guard\Guards\InstanceGuards;
use EventMachinePHP\Guard\Guards\IterableGuards;
use EventMachinePHP\Guard\Guards\ResourceGuards;
use EventMachinePHP\Guard\Guards\CountableGuards;
use EventMachinePHP\Guard\Guards\ExceptionGuards;
use EventMachinePHP\Guard\Guards\ComparisonGuards;

class Guard
{
    use ArrayGuards;
    use BooleanGuards;
    use CallableGuards;
    use ClassGuards;
    use ComparisonGuards;
    use CountableGuards;
    use CtypeGuards;
    use EmptyGuards;
    use ExceptionGuards;
    use EqualityGuards;
    use InstanceGuards;
    use NumericGuards;
    use IterableGuards;
    use NullGuards;
    use ObjectGuards;
    use RangeGuards;
    use ResourceGuards;
    use ScalarGuards;
    use StringGuards;

    /**
     * The constructor is private to prevent instantiation of the class.
     */
    private function __construct(
    ) {
    }

    // TODO: Look through Laravel validation rules, take not laravel specific ones, if not already implemented
    // TODO: Core_c: Loop through interfaces, using instance of
    // TODO: Look for php aliases methods
    // TODO: standard_5: function is_ (Search)
    // TODO: Look for examples on php.net for native functions, use them in tests
    // TODO: * @see number_of() :alias:
    // TODO: Update type tests using IntegerTest cases
    // TODO: https://github.com/php-strictus/strictus
    // TODO: Consider isJsonSring?
    // TODO: ? OfAny Guards: --> is_istance_of_any, is_array_of_any, is_bool_of_any...
    // TODO: Guard::not()->emptyOr()->isString()->isClassString() ????
    // TODO: dataset's has duplicate test cases?
    // TODO: Loop through Pest's expectations: toBeNull, toBeNAN?
    // TODO: Consider thatAll(): Validates all rules and then return the failed ones
    // TODO: Consider ThatAny(): Validates and returns the value if any rule passed
    // TODO: https://github.com/spatie/pest-expectations
    // TODO: Consider AllNullOr Guards

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

    // region Combination Guards

    public static function not(): NotGuard
    {
        return NotGuard::getInstance();
    }

    public static function nullOr(): NullOrGuard
    {
        return NullOrGuard::getInstance();
    }

    public static function that(mixed $value): LazyGuard
    {
        return new LazyGuard($value);
    }

    public static function all(): AllGuard
    {
        return AllGuard::getInstance();
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
            return match ($value) {
                "\r"    => '<CR>',
                "\n"    => '<LF>',
                "\t"    => '<HT>',
                default => '"'.$value.'"',
            };
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
