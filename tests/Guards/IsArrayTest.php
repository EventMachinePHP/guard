<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isArray(passing)')
    ->with('isArray(passing)')
    ->expect(fn ($value) => Guard::isArray(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeArray()
    ->notToThrowInvalidArgumentException();

test('Guard::isArray(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isArray(failing)')
    ->expect(fn ($value, $message) => Guard::isArray(value: $value));

test('Guard::isArray() Aliases')
    ->expect('isArray')
    ->validateAliases();

dataset('isArray(passing)', [
    '([])'        => [[]],
    '([1, 2, 3])' => [[1, 2, 3]],
]);
dataset('isArray(failing)', [
    '(123)'                   => [123, 'Expected an array. Got: 123 (int)'],
    '(new stdClass())'        => [new stdClass(), 'Expected an array. Got: stdClass (stdClass)'],
    '(new ArrayIterator([]))' => [new ArrayIterator([]), 'Expected an array. Got: ArrayIterator (ArrayIterator)'],
]);
