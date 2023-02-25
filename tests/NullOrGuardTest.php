<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Guards\ExceptionGuards;
use EventMachinePHP\Guard\Exceptions\NullOrGuardExceptionGuard;

describe('NullOr Guard: ', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        if ($trait->getName() === ExceptionGuards::class) {
            continue;
        }

        foreach ($trait->getMethods(filter: ReflectionMethod::IS_PUBLIC) as $method) {
            test('nullOr()->'.$method->getName().'(null)', function () use ($method): void {
                expect(Guard::nullOr()->{$method->getName()}(null))
                    ->toBeNull();
            });

            $passingCase = randomPassingCaseWithDescription($method->getName());
            test('nullOr()->'.$method->getName().'(pass) with:'.Guard::valueToString($passingCase['description']), function () use ($method, $passingCase): void {
                $passingCase = $passingCase['case'];

                expect(Guard::nullOr()->{$method->getName()}(...$passingCase))
                    ->toBe($passingCase[array_key_first($passingCase)]);
            });

            $failingCase = randomFailingCaseWithDescription($method->getName());
            test('nullOr()->'.$method->getName().'(fail) with: '.Guard::valueToString($failingCase['description']), function () use ($failingCase, $method): void {
                $failingCase = $failingCase['case'];

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
