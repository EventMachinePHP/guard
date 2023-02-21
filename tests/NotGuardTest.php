<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Exceptions\NotGuardException;

describe('Not Guard: ', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        foreach ($trait->getMethods(filter: ReflectionMethod::IS_PUBLIC) as $method) {
            $passingCase = randomPassingCaseWithDescription($method->getName());
            test('not()->'.$method->getName().'(pass) with: '.Guard::valueToString($passingCase['description']), function () use ($passingCase, $method): void {
                $this->expectException(NotGuardException::class);

                $passingCase = $passingCase['case'];

                Guard::not()->{$method->getName()}(...$passingCase);
            });

            $failingCase = randomFailingCaseWithDescription($method->getName());
            test('not()->'.$method->getName().'(fail) with: '.Guard::valueToString($failingCase['description']), function () use ($method, $failingCase): void {
                $failingCase = $failingCase['case'];
                expect(Guard::not()->{$method->getName()}(...$failingCase))
                    ->toBe($failingCase[array_key_first($failingCase)]);
            });
        }
    }
});
