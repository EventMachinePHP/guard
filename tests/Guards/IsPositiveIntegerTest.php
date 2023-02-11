<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isPositiveInteger(passing)')
    ->with('isPositiveInteger(passing)')
    ->expect(fn ($value) => Guard::isPositiveInteger(value: $value))
    ->toHaveValue(fn ($value) => $value)
    ->toBeInt()
    ->toBeGreaterThan(0)
    ->notToThrowInvalidArgumentException();

test('Guard::isPositiveInteger(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isPositiveInteger(failing)')
    ->expect(fn ($value, $message) => Guard::isPositiveInteger(value: $value));

test('Guard::isPositiveInteger() Aliases')
    ->expect('isPositiveInteger')
    ->validateAliases();

dataset('isPositiveInteger(passing)', [
    '(123)' => [123],
    '(1)'   => [1],
]);
dataset('isPositiveInteger(failing)', [
    '(-123)'   => [-123, 'Expected a value greater than: 0 (int). Got: -123 (int)'],
    '(0)'      => [0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
    '(0.0)'    => [0.0, 'Expected an integer. Got: float'],
    "('123')"  => ['123', 'Expected an integer. Got: string'],
    "('-123')" => ['-123', 'Expected an integer. Got: string'],
    "('0')"    => ['0', 'Expected an integer. Got: string'],
    '(1.0)'    => [1.0, 'Expected an integer. Got: float'],
    '(1.23)'   => [1.23, 'Expected an integer. Got: float'],
]);
