<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use ReflectionClass;
use function is_array;
use BadMethodCallException;
use EventMachinePHP\Guard\Guards\ArrayGuards;
use EventMachinePHP\Guard\Guards\FloatGuards;
use EventMachinePHP\Guard\Guards\ObjectGuards;
use EventMachinePHP\Guard\Guards\ScalarGuards;
use EventMachinePHP\Guard\Guards\StringGuards;
use EventMachinePHP\Guard\Guards\BooleanGuards;
use EventMachinePHP\Guard\Guards\IntegerGuards;
use EventMachinePHP\Guard\Guards\CallableGuards;
use EventMachinePHP\Guard\Guards\EqualityGuards;
use EventMachinePHP\Guard\Guards\InstanceGuards;
use EventMachinePHP\Guard\Guards\IterableGuards;
use EventMachinePHP\Guard\Guards\ResourceGuards;
use EventMachinePHP\Guard\Guards\CountableGuards;
use EventMachinePHP\Guard\Guards\ComparisonGuards;

class Guard
{
    use Helpers;
    use ArrayGuards;
    use BooleanGuards;
    use CallableGuards;
    use ComparisonGuards;
    use CountableGuards;
    use EqualityGuards;
    use FloatGuards;
    use InstanceGuards;
    use IntegerGuards;
    use IterableGuards;
    use ObjectGuards;
    use ResourceGuards;
    use ScalarGuards;
    use StringGuards;

    /**
     * The constructor is private to prevent instantiation of the class.
     */
    private function __construct()
    {
    }

    // TODO: Core_c: Loop through interfaces, using instance of
    // TODO: Look for php aliases methods
    // TODO: standard_5: function is_ (Search)
    // TODO: Look for examples on php.net for native functions, use them in tests
    // TODO: * @see number_of() :alias:
    // TODO: Update type tests using IntegerTest cases

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
}
