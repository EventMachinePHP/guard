<?php

declare(strict_types=1);

use Pest\Datasets;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Tests\TestCase;

/* @infection-ignore-all */
uses(TestCase::class)->in(__DIR__);

/**
 * Gets the argument string for a method.
 *
 * This function uses the `ReflectionMethod` class to retrieve the parameters of a method
 * and generate a string representation of the parameters with their types and default values.
 * If a parameter has a type, it is included in the string representation. If it does not have
 * a type, it is set to "mixed". If a parameter has a default value, it is also included in the
 * string representation.
 *
 * @param  ReflectionMethod  $method The reflection method.
 *
 * @return string The argument string for the method, with each argument separated by a comma.
 *
 * @infection-ignore-all
 */
function getMethodArgumentString(ReflectionMethod $method): string
{
    $parameters = $method->getParameters();

    $parameterDefinitions = [];
    foreach ($parameters as $parameter) {
        $type = $parameter->hasType()
            ? (string) $parameter->getType()
            : 'mixed';
        $defaultValue = $parameter->isDefaultValueAvailable()
            ? ' = '.strtolower(var_export($parameter->getDefaultValue(), true))
            : '';
        $parameterDefinitions[] = "{$type} \$".$parameter->getName().$defaultValue;
    }

    return implode(', ', $parameterDefinitions);
}

/**
 * Generates the docblock definition for a method alias.
 *
 * @param  ReflectionMethod  $method The reflection method.
 * @param  string  $alias  The alias for the method.
 *
 * @return string The docblock definition for the method alias.
 *
 * @infection-ignore-all
 */
function generateMethodDocBlockDefinition(ReflectionMethod $method, string $alias): string
{
    $returnType = (string) ($method->getReturnType() ?? 'mixed');

    return sprintf(
        '@method static %s %s(%s) Alias of {@see Guard::%s()}',
        $returnType,
        $alias,
        getMethodArgumentString($method),
        $method->getName(),
    );
}

/** @infection-ignore-all */
function generateMethodDocBlockDefinitionErrorMessage(string $alias, string $traitName): string
{
    return "Method alias '{$alias}' is not (correctly) documented in trait '{$traitName}' docblock.";
}

/**
 * Generates the `@ see` definition for a method alias.
 *
 * @param  string  $alias The alias for the method.
 *
 * @return string The `@ see` definition for the method alias.
 *
 * @infection-ignore-all
 */
function generateMethodAliasSeeDefinition(string $alias): string
{
    return '@see Alias: Guard::'.$alias.'()';
}

/** @infection-ignore-all */
function generateMethodAliasSeeDefinitionErrorMessage(ReflectionMethod $method): string
{
    $aliasSeeBlock = '';
    foreach ($method->getAttributes() as $attribute) {
        $attributeArguments = $attribute->getArguments()[0];
        $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];
        foreach ($aliasMethodNames as $alias) {
            $aliasSeeBlock .= '* '.generateMethodAliasSeeDefinition($alias).PHP_EOL;
        }
    }

    return "Method aliases is not (correctly) documented in method '{$method->getName()}' docblock.".PHP_EOL.
        'It should look like this:'.PHP_EOL.$aliasSeeBlock;
}

/** @infection-ignore-all */
function generateTraitDocBlockForAliases(ReflectionClass $trait)
{
    $docBlock = <<<'DOC'
    /**
    * This trait contains methods for validating [replace] values.
    *
    
    DOC;

    foreach ($trait->getMethods() as $method) {
        $attributes = $method->getAttributes();
        foreach ($attributes as $attribute) {
            $attributeArguments = $attribute->getArguments()[0];
            $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];
            foreach ($aliasMethodNames as $alias) {
                $docBlock .= '* '.generateMethodDocBlockDefinition($method, $alias).PHP_EOL;
            }
        }
    }

    $docBlock .= '*/';

    return 'Trait '.$trait->getName().' does not have a docblock. Here is the generated docblock:'.PHP_EOL.$docBlock;
}

/*
 * The toHaveValue extension for Pest evaluates a closure
 * and asserts its return value against the expected
 * value using the data provided to the test case.
 *
 * @infection-ignore-all
 */
expect()->extend('toHaveValue', function ($callable): Pest\Expectation {
    $value = $callable(...)->bindTo(test())(...test()->getProvidedData());

    return $this->toBe($value);
});

/* @infection-ignore-all */
expect()->extend('toHaveValueThat', function (string $assertionName, callable $callable): Pest\Expectation {
    return $this->$assertionName($callable(...)->bindTo(test())(...test()->getProvidedData()));
});

/*
 * Adds a custom expectation to the test case to check that an
 * exception of type `InvalidArgumentException` is not thrown.
 *
 * @infection-ignore-all
 */
expect()->extend('notToThrowInvalidArgumentException', function () {
    return $this
        ->not()
        ->toThrow(EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException::class);
});

/*
 * The "validateAliases" Pest extension method tests each alias method for the
 * passed in ReflectionMethod instance and asserts that it does not throw an
 * InvalidArgumentException when passed valid arguments, and does throw an
 * InvalidArgumentException when passed invalid arguments.
 *
 * @infection-ignore-all
 */
expect()->extend('validateAliases', function (): void {
    $reflectionMethod = new ReflectionMethod(Guard::class, $this->value);
    $attributes       = $reflectionMethod->getAttributes();

    if ($attributes === []) {
        throw new InvalidArgumentException(sprintf('No alias attributes found for the method: %s. Is the alias test for this method necessary?', $reflectionMethod->getName()));
    }

    foreach ($attributes as $attribute) {
        $attributeArguments = $attribute->getArguments()[0];
        $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];

        foreach ($aliasMethodNames as $aliasMethodName) {
            $passingArguments = Datasets::get($reflectionMethod->getName().'(passing)');
            $passingArguments = $passingArguments[array_key_first($passingArguments)];

            $failingArguments = Datasets::get($reflectionMethod->getName().'(failing)');
            $failingArguments = $failingArguments[array_key_first($failingArguments)];
            array_pop($failingArguments);

            expect(call_user_func([Guard::class, $aliasMethodName], ...$passingArguments))
                ->notToThrowInvalidArgumentException()
                ->and(fn () => call_user_func([Guard::class, $aliasMethodName], ...$failingArguments))
                ->toThrow(\EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException::class);
        }
    }
});
