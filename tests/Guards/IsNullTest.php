<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isNull(passing)')
    ->with('isNull(passing)')
    ->expect(fn ($value) => Guard::isNull(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeNull()
    ->notToThrowInvalidArgumentException();

test('Guard::isNull(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isNull(failing)')
    ->expect(fn ($value, $message) => Guard::isNull(value: $value));

test('Guard::isNull() Aliases')
    ->expect('isNull')
    ->validateAliases();

dataset('isNull(passing)', [
    '(null)' => [null],
]);
dataset('isNull(failing)', [
    '(false)' => [false, 'Expected null. Got: false (bool)'],
    '(0)'     => [0, 'Expected null. Got: 0 (int)'],
    '(0.0)'   => [0.0, 'Expected null. Got: 0 (float)'],
    "('')"    => ['', 'Expected null. Got: "" (string)'],
    '([])'    => [[], 'Expected null. Got: array (array)'],
]);
