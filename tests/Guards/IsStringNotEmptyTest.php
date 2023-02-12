<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isStringNotEmpty(passing)')
    ->with('isStringNotEmpty(passing)')
    ->expect(fn ($value) => Guard::isStringNotEmpty(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeString()
    ->notToThrowInvalidArgumentException();

test('Guard::isStringNotEmpty(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isStringNotEmpty(failing)')
    ->expect(fn ($value, $message) => Guard::isStringNotEmpty(value: $value));

test('Guard::stringNotEmpty() Aliases')
    ->expect('isStringNotEmpty')
    ->validateAliases();

dataset('isStringNotEmpty(passing)', [
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);
dataset('isStringNotEmpty(failing)', [
    "('')" => ['', 'Expected a value different from: "" (string). Got: "" (string)'],
    '(1)'  => [1, 'Expected a string. Got: 1 (int)'],
]);
