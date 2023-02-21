<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Helpers;
use EventMachinePHP\Guard\Exceptions\NotGuardException;

describe('Not Guard: ', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        if ($trait->getName() === Helpers::class) {
            continue;
        }

        foreach ($trait->getMethods(filter: ReflectionMethod::IS_PUBLIC) as $method) {
            test('not()->'.$method->getName().'(pass)', function () use ($method): void {
                $this->expectException(NotGuardException::class);

                $passingCase = randomPassingCase($method->getName());

                Guard::not()->{$method->getName()}(...$passingCase);
            });

            test('not()->'.$method->getName().'(fail)', function () use ($method): void {
                $failingCase = randomFailingCase($method->getName());

                expect(Guard::not()->{$method->getName()}(...$failingCase))
                    ->toBe($failingCase[array_key_first($failingCase)]);
            });
        }
    }
});
