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
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        $traitDocComment = $trait->getDocComment();
        if ($traitDocComment === false) {
            $this->fail('Trait '.$trait->getName().' does not have a docblock.');
        }

        foreach ($trait->getMethods() as $method) {
            $methodDocComment = $method->getDocComment();

            foreach ($method->getAttributes() as $attribute) {
                $attributeArguments = $attribute->getArguments()[0];
                $aliasMethodNames   = is_array($attributeArguments) ? $attributeArguments : [$attributeArguments];

                foreach ($aliasMethodNames as $alias) {
                    $this->assertStringContainsString(
                        needle: generateMethodDocBlockDefinition($method, $alias),
                        haystack: $traitDocComment,
                        message: generateMethodDocBlockDefinitionErrorMessage($alias, $trait->getName()),
                    );

                    $this->assertStringContainsString(
                        needle: generateMethodAliasSeeDefinition($alias),
                        haystack: $methodDocComment,
                        message: generateMethodAliasSeeDefinitionErrorMessage($alias, $method->getName()),
                    );
                }
            }
        }
    }
});
