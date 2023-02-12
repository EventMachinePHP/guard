<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isCallable(passing)')
    ->with('isCallable(passing)')
    ->expect(fn ($value) => Guard::isCallable(value: $value))
    ->toHaveValue(fn ($value) => $value)
    ->toBeCallable()
    ->notToThrowInvalidArgumentException();

test('Guard::isCallable(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isCallable(failing)')
    ->expect(fn ($value, $message) => Guard::isCallable(value: $value));

test('Guard::isCallable() Aliases')
    ->expect('isCallable')
    ->validateAliases();

dataset('isCallable(passing)', [
    '(strlen)'                                 => ['strlen'],
    '(fn (): Closure => function (): void {})' => [fn (): Closure => function (): void {}],
]);
dataset('isCallable(failing)', [
    '(1234)'  => [1234, 'Expected a callable. Got: 1234 (int)'],
    "('foo')" => ['foo', 'Expected a callable. Got: "foo" (string)'],
]);
