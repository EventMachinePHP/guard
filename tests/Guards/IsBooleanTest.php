<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isBoolean(passing)')
    ->with('isBoolean(passing)')
    ->expect(fn ($value) => Guard::isBoolean(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeBool()
    ->notToThrowInvalidArgumentException();

test('Guard::isBoolean(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isBoolean(failing)')
    ->expect(fn ($value, $message) => Guard::isBoolean(value: $value));

test('Guard::isBoolean() Aliases')
    ->expect('isBoolean')
    ->validateAliases();

dataset('isBoolean(passing)', [
    '(true)'  => [true],
    '(false)' => [false],
]);
dataset('isBoolean(failing)', [
    '(1)'   => [1, 'Expected a boolean value. Got: 1 (int)'],
    "('1')" => ['1', 'Expected a boolean value. Got: "1" (string)'],
]);
