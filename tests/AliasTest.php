<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('there is no duplicate method aliases', function (): void {
    $methodAliases = [];

    $class = new ReflectionClass(Guard::class);

    foreach ($class->getMethods() as $method) {
        foreach ($method->getAttributes() as $attribute) {
            $attributeArguments = $attribute->getArguments()[0];
            $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];
            foreach ($aliasMethodNames as $alias) {
                $prevMethod = $methodAliases[$alias] ?? null;

                $this->assertArrayNotHasKey(
                    key: $alias,
                    array: $methodAliases,
                    message: "Method alias '".$alias."' is already used by method Guard::".$prevMethod.'().',
                );

                $methodAliases[$alias] = $method->getName();
            }
        }
    }
});

test('aliases should be documented on trait and methods docblocks', function (): void {
    // Create a ReflectionClass instance for the Guard class
    $reflectionClass = new ReflectionClass(Guard::class);

    // Create an array to store the count of aliases by trait
    $aliasCountByTraits = array_fill_keys($reflectionClass->getTraitNames(), 0);

    // Create an array to store the aliases for each method
    $aliasesByMethods = [];

    // Get all the traits used by the Guard class
    $traits = $reflectionClass->getTraits();

    // Iterate over each trait and its methods
    foreach ($traits as $trait) {
        foreach ($trait->getMethods() as $method) {
            // Check if the method has any attributes
            foreach ($method->getAttributes() as $attribute) {
                // Get the arguments for the attribute
                $attributeArguments = $attribute->getArguments()[0];

                // Convert the argument to an array if it's not already
                $aliasMethodNames = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];

                // Increment the alias count for the trait and store the alias for the method
                foreach ($aliasMethodNames as $alias) {
                    $aliasesByMethods[$method->getName()][] = $alias;
                    $aliasCountByTraits[$trait->getName()]++;
                }
            }
        }
    }

    // Iterate over each trait
    foreach ($traits as $trait) {
        // Skip the trait if it has no aliases
        if ($aliasCountByTraits[$trait->getName()] === 0) {
            continue;
        }

        // Get the docblock for the trait
        $traitDocComment = $trait->getDocComment();

        // If the trait does not have a docblock, fail the test
        if ($traitDocComment === false) {
            $this->fail(generateTraitDocBlockForAliases($trait));
        }

        // Iterate over each method in the trait
        foreach ($trait->getMethods() as $method) {
            // Skip the method if it has no aliases
            if (!isset($aliasesByMethods[$method->getName()])) {
                continue;
            }

            // Iterate over each alias for the method
            foreach ($method->getAttributes() as $attribute) {
                $attributeArguments = $attribute->getArguments()[0];
                $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];
                foreach ($aliasMethodNames as $alias) {
                    // Check if the alias is documented in the trait docblock
                    $this->assertStringContainsString(
                        needle: generateMethodDocBlockDefinition($method, $alias),
                        haystack: $traitDocComment,
                        message: generateMethodDocBlockDefinitionErrorMessage($alias, $trait->getName()),
                    );

                    // Check if the alias is documented in the method docblock
                    $this->assertStringContainsString(
                        needle: generateMethodAliasSeeDefinition($alias),
                        haystack: $method->getDocComment() === false ? '' : $method->getDocComment(),
                        message: generateMethodAliasSeeDefinitionErrorMessage($method),
                    );
                }
            }
        }
    }
})
    ->depends(tests:'there is no duplicate method aliases');
