<?php

declare(strict_types=1);

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
 */
function generateMethodDocBlockDefinition(ReflectionMethod $method, string $alias): string
{
    return sprintf(
        '@method static %s %s(%s) @see Guard::%s()',
        $method->getReturnType() ?? 'mixed',
        $alias,
        getMethodArgumentString($method),
        $method->getName(),
    );
}

/**
 * Generates the `@ see` definition for a method alias.
 *
 * @param  string  $alias The alias for the method.
 *
 * @return string The `@ see` definition for the method alias.
 */
function generateMethodAliasSeeDefinition(string $alias): string
{
    return '@see Guard::'.$alias.'()';
}
