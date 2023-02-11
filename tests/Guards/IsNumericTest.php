<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isNumeric(passing)')
    ->with('isNumeric(passing)')
    ->expect(fn ($value) => Guard::isNumeric(value: $value))
    ->toHaveValue(fn ($value) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isNumeric(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isNumeric(failing)')
    ->expect(fn ($value, $message) => Guard::isNumeric(value: $value));

test('Guard::isNumeric() Aliases')
    ->expect('isNumeric')
    ->validateAliases();

dataset('isNumeric(passing)', [
    '(1.0)'   => [1.0],
    '(1.23)'  => [1.23],
    '(123)'   => [123],
    "('123')" => ['123'],
]);
dataset('isNumeric(failing)', [
    "('foo')" => ['foo', 'Expected a numeric value. Got: "foo" (string)'],
]);
