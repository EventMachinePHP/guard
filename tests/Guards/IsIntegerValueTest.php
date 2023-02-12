<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isIntegerValue(passing)')
    ->with('isIntegerValue(passing)')
    ->expect(fn ($value) => Guard::isIntegerValue(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isIntegerValue(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isIntegerValue(failing)')
    ->expect(fn ($value, $message) => Guard::isIntegerValue(value: $value));

test('Guard::isIntegerValue() Aliases')
    ->expect('isIntegerValue')
    ->validateAliases();

dataset('isIntegerValue(passing)', [
    '(123)'   => [123],
    '(1.0)'   => [1.0],
    "('123')" => ['123'],
]);
dataset('isIntegerValue(failing)', [
    '(12.34)'  => [12.34, 'Expected an isIntegerValue value. Got: 12.34 (float)'],
    '(true)'   => [true, 'Expected an isIntegerValue value. Got: true (bool)'],
    '(null)'   => [null, 'Expected an isIntegerValue value. Got: null (null)'],
    '(array)'  => [[], 'Expected an isIntegerValue value. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected an isIntegerValue value. Got: stdClass (stdClass)'],
]);
