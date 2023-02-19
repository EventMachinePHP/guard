<?php

declare(strict_types=1);

use function Ozzie\Nest\test;
use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

describe('Failing Guards:', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        if (!str_ends_with($trait->getName(), 'Guards')) {
            continue;
        }

        foreach ($trait->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            test($method->getName().'(failing)')
                ->with(lcfirst($method->getName()).'.failing')
                ->expectException(InvalidGuardArgumentException::class)
                ->expectExceptionMessage(fn (...$arguments) => $arguments)
                ->expect(function (...$arguments) use ($method) {
                    return call_user_func([Guard::class, $method->getName()], ...$arguments);
                });
        }
    }
});
