<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isFalse(passing)')
    ->with('isFalse(passing)')
    ->expect(fn ($value) => Guard::isFalse(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeFalse()
    ->notToThrowInvalidArgumentException();

test('Guard::isFalse(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isFalse(failing)')
    ->expect(fn ($value, $message) => Guard::isFalse(value: $value));

test('Guard::isFalse() Aliases')
    ->expect('isFalse')
    ->validateAliases();

dataset('isFalse(passing)', [
    '(false)' => [false],
]);
dataset('isFalse(failing)', [
    '(true)' => [true, 'a'],
    '(1)'    => [1, 'a'],
    '(null)' => [null, 'a'],
]);
