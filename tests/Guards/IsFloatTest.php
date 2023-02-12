<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isFloat(passing)')
    ->with('isFloat(passing)')
    ->expect(fn ($value) => Guard::isFloat(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeFloat()
    ->notToThrowInvalidArgumentException();

test('Guard::isFloat(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isFloat(failing)')
    ->expect(fn ($value, $message) => Guard::isFloat(value: $value));

test('Guard::isFloat() Aliases')
    ->expect('isFloat')
    ->validateAliases();

dataset('isFloat(passing)', [
    '(1.0)'  => [1.0],
    '(1.23)' => [1.23],
]);
dataset('isFloat(failing)', [
    '(123)'   => [123, 'Expected a float. Got: 123 (int)'],
    "('123')" => ['123', 'Expected a float. Got: "123" (string)'],
]);
