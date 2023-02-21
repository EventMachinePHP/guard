<?php

declare(strict_types=1);

use Pest\Datasets;
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
                $passingCases    = Datasets::get($method->getName().PASSING_CASES);
                $passingCaseKeys = array_keys($passingCases);
                $passingCases    = $passingCases[$passingCaseKeys[array_rand($passingCaseKeys)]];

                $this->expectException(NotGuardException::class);

                Guard::not()->{$method->getName()}(...$passingCases);
            });

            test('not()->'.$method->getName().'(fail)', function () use ($method): void {
                $failingCases    = Datasets::get($method->getName().FAILING_CASES);
                $failingCaseKeys = array_keys($failingCases);
                $failingCases    = $failingCases[$failingCaseKeys[array_rand($failingCaseKeys)]];
                array_pop($failingCases);

                expect(Guard::not()->{$method->getName()}(...$failingCases))
                    ->toBe($failingCases[array_key_first($failingCases)]);
            });
        }
    }
});
