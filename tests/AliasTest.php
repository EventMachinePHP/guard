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
