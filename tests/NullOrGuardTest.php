<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Exceptions\NullOrGuardExceptionGuard;

describe('NullOr Guard: ', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        foreach ($trait->getMethods(filter: ReflectionMethod::IS_PUBLIC) as $method) {
            test('nullOr()->'.$method->getName().'(null)', function () use ($method): void {
                expect(Guard::nullOr()->{$method->getName()}(null))
                    ->toBeNull();
            });

            test('nullOr()->'.$method->getName().'(pass)', function () use ($method): void {
                $passingCase = randomPassingCase($method->getName());

                expect(Guard::nullOr()->{$method->getName()}(...$passingCase))
                    ->toBe($passingCase[array_key_first($passingCase)]);
            });

            $failingCase = randomFailingCase($method->getName());

            test('nullOr()->'.$method->getName().'(fail) with: '.Guard::valueToString(...$failingCase), function () use ($failingCase, $method): void {
                if ($failingCase[array_key_first($failingCase)] === null) {
                    expect(true)->toBeTrue();
                } else {
                    $this->expectException(NullOrGuardExceptionGuard::class);

                    Guard::nullOr()->{$method->getName()}(...$failingCase);
                }
            });
        }
    }
});
