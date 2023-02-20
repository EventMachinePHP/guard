<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use EventMachinePHP\Guard\Tests\Fixtures\A;
use EventMachinePHP\Guard\Tests\Fixtures\B;

dataset(passingCasesDescription(filePath: __FILE__), [
    '(\EventMachinePHP\Guard\Tests\TestCase::class, TestCase::class)' => [\EventMachinePHP\Guard\Tests\TestCase::class, TestCase::class],
    '(A::class, stdClass::class)'                                     => [A::class, stdClass::class],
    '(new A(), new stdClass())'                                       => [new A(), new stdClass()],
    '(B::class, A::class)'                                            => [B::class, A::class],
    '(B::class, new A())'                                             => [B::class, new A()],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(A::class, B::class)'                   => [A::class, B::class, 'Expected a subclass of EventMachinePHP\Guard\Tests\Fixtures\B. Got: "EventMachinePHP\Guard\Tests\Fixtures\A" (string)'],
    "(B::class, 'not-exists-parent::class')" => [B::class, 'not-exists-parent::class', 'Expected a subclass of not-exists-parent::class. Got: "EventMachinePHP\Guard\Tests\Fixtures\B" (string)'],
    "('not-exists::class', A::class)"        => ['not-exists::class', A::class, 'Expected a subclass of EventMachinePHP\Guard\Tests\Fixtures\A. Got: "not-exists::class" (string)'],
]);
