<?php

declare(strict_types=1);

use Pest\Datasets;
use EventMachinePHP\Guard\Tests\TestCase;

const PASSING_CASES  = '(pass)';
const FAILING_CASES  = '(fail)';
const ERROR_MESSAGES = '(message)';

const CUSTOM_ERROR_MESSAGE = 'Custom Error Message';

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
    return '@see Alias: {@see Guard::'.$alias.'()}';
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
function generateTraitDocBlockForAliases(ReflectionClass $trait): string
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

function randomPassingCaseWithDescription(string $methodName): array
{
    $passingCases   = Datasets::get($methodName.PASSING_CASES);
    $passingCaseKey = array_rand($passingCases);

    return [
        'description' => $passingCaseKey,
        'case'        => $passingCases[$passingCaseKey],
    ];
}

function randomPassingCase(string $methodName): array
{
    return randomPassingCaseWithDescription($methodName)['case'];
}

function randomFailingCaseWithDescription(string $filePath): array
{
    if (str_contains($filePath, '.php')) {
        $failingCases = Datasets::get(failingCasesDataset($filePath));

        return [$failingCases[array_rand($failingCases)]];
    }

    $failingCases   = Datasets::get($filePath.FAILING_CASES);
    $failingCaseKey = array_keys($failingCases);
    $failingCases   = $failingCases[$failingCaseKey[array_rand($failingCaseKey)]];
    array_pop($failingCases);

    return [
        'description' => $failingCaseKey,
        'case'        => $failingCases,
    ];
}

function randomFailingCase(string $filePath): array
{
    $case = randomFailingCaseWithDescription($filePath);

    return $case['case'] ?? $case;
}

function guardNameFromFile(string $filePath): string
{
    $parts    = explode('/', $filePath);
    $fileName = array_pop($parts);

    return lcfirst(str_replace(['Test.php', 'Dataset.php', '.php'], '', $fileName));
}

function passingCasesDescription(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).PASSING_CASES;
}

function failingCasesDescription(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).FAILING_CASES;
}

function errorMessagesDescription(string $filePath): string
{
    return str_replace('Dataset', '', guardNameFromFile($filePath)).ERROR_MESSAGES;
}

function passingCasesDataset(string $filePath): string
{
    return guardNameFromFile($filePath).PASSING_CASES;
}

function failingCasesDataset(string $filePath): string
{
    return guardNameFromFile($filePath).FAILING_CASES;
}

/**
 * Retrieves the test cases for the given case names.
 *
 * @param  array  $caseNames  An array of case names.
 *
 * @return array An array containing the test cases.
 */
function testCases(array $caseNames): array
{
    $cases = [];

    foreach ($caseNames as $case) {
        $cases[$case->value] = [GuardTestCase::case($case)];
    }

    return $cases;
}

/**
 * Retrieves all guard test cases except the ones provided in the $except array.
 *
 * @param  array  $except  An array of guard test cases to exclude.
 *
 * @return array The filtered array of guard test cases, indexed by their values.
 */
function allCases(array $except = []): array
{
    $except = array_map(fn ($case) => $case->name, $except);

    $cases = [];

    foreach (GuardTestCase::cases() as $case) {
        if (!in_array($case->name, $except, true)) {
            $cases[$case->value] = [GuardTestCase::case($case)];
        }
    }

    return $cases;
}

/**
 * Generates an array of randomly selected Guard Test Cases, with the exception of specified cases.
 *
 * @param  array  $except  An array of cases to be excluded from the random selection
 *
 * @return array An array of randomly selected Guard Test Cases
 */
function randomCase(array $except = []): array
{
    $exceptNames = array_flip(array_map(fn ($case) => $case->name, $except));

    $cases = GuardTestCase::cases();

    shuffle($cases);

    foreach ($cases as $case) {
        if (!isset($exceptNames[$case->name])) {
            return [GuardTestCase::case($case)];
        }
    }

    return [];
}
