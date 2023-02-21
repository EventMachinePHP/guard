<?php

declare(strict_types=1);

use function Ozzie\Nest\test;
use EventMachinePHP\Guard\Guard;
use function Ozzie\Nest\describe;
use EventMachinePHP\Guard\Helpers;

describe('Guard has Test: ', function (): void {
    $reflectionClass = new ReflectionClass(Guard::class);
    $traits          = $reflectionClass->getTraits();

    foreach ($traits as $trait) {
        if ($trait->getName() === Helpers::class) {
            continue;
        }

        foreach ($trait->getMethods(filter: ReflectionMethod::IS_PUBLIC) as $method) {
            test($method->getName().'()', function () use ($method): void {
                $testFilePath = __DIR__.'/Guards/'.ucfirst($method->getName()).'Test.php';

                $this->assertFileExists($testFilePath, message: 'Test file for Guard::'.$method->getName().'() does not exist');
            });
        }
    }
});
