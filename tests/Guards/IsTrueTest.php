<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isTrue(passing)')
    ->with('isTrue(passing)')
    ->expect(fn ($value) => Guard::isTrue(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeTrue()
    ->notToThrowInvalidArgumentException();

test('Guard::isTrue(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isTrue(failing)')
    ->expect(fn ($value, $message) => Guard::isTrue(value: $value));

test('Guard::isTrue() Aliases')
    ->expect('isTrue')
    ->validateAliases();

dataset('isTrue(passing)', [
    '(true)' => [true],
]);
dataset('isTrue(failing)', [
    '(false)' => [false, 'Expected a value to be true. Got: false (bool)'],
    '(1)'     => [1, 'Expected a value to be true. Got: 1 (int)'],
    '(null)'  => [null, 'Expected a value to be true. Got: null (null)'],
]);
