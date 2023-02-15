<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use EventMachinePHP\Guard\Guard;

test('Guard::isSubClassOf(passing)')
    ->with('isSubClassOf(passing)')
    ->expect(fn ($value, $parentClass) => Guard::isSubClassOf(value: $value, parentClass: $parentClass))
    ->notToThrowInvalidArgumentException();

test('Guard::isSubClassOf(failing)')
    ->expectInvalidArgumentException(fn ($value, $parentClass, $message) => $message)
    ->with('isSubClassOf(failing)')
    ->expect(fn ($value, $parentClass, $message) => Guard::isSubClassOf(value: $value, parentClass: $parentClass));

test('Guard::isSubClassOf() Aliases')
    ->expect('isSubClassOf')
    ->validateAliases();

class A extends stdClass
{
}
class B extends A
{
}

dataset('isSubClassOf(passing)', [
    '(\EventMachinePHP\Guard\Tests\TestCase::class, TestCase::class)' => [\EventMachinePHP\Guard\Tests\TestCase::class, TestCase::class],
    '(A::class, stdClass::class)'                                     => [A::class, stdClass::class],
    '(new A(), new stdClass())'                                       => [new A(), new stdClass()],
    '(B::class, A::class)'                                            => [B::class, A::class],
    '(B::class, new A())'                                             => [B::class, new A()],
]);
dataset('isSubClassOf(failing)', [
    [A::class, B::class, 'Expected a subclass of B. Got: "A" (string)'],
    [B::class, 'not-exists-parent::class', 'Expected a subclass of not-exists-parent::class. Got: "B" (string)'],
    ['not-exists::class', A::class, 'Expected a subclass of A. Got: "not-exists::class" (string)'],
]);
