<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isObject(passing)')
    ->with('isObject(passing)')
    ->expect(fn ($value) => Guard::isObject(value: $value))
    ->toHaveValue(fn ($value) => $value)
    ->toBeObject()
    ->notToThrowInvalidArgumentException();

test('Guard::isObject(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isObject(failing)')
    ->expect(fn ($value, $message) => Guard::isObject(value: $value));

test('Guard::isObject() Aliases')
    ->expect('isObject')
    ->validateAliases();

dataset('isObject(passing)', [
    '(new stdClass())'         => [new stdClass()],
    '(new RuntimeException())' => [new RuntimeException()],
]);
dataset('isObject(failing)', [
    '(null)' => [null, 'Expected an object. Got: null (null)'],
    '(true)' => [true, 'Expected an object. Got: true (bool)'],
    '(1)'    => [1, 'Expected an object. Got: 1 (int)'],
    '([])'   => [[], 'Expected an object. Got: array (array)'],
]);
