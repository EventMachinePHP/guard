<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isArrayAccessible(passing)')
    ->with('isArrayAccessible(passing)')
    ->expect(fn ($value) => Guard::isArrayAccessible(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isArrayAccessible(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isArrayAccessible(failing)')
    ->expect(fn ($value, $message) => Guard::isArrayAccessible(value: $value));

test('Guard::isArrayAccessible() Aliases')
    ->expect('isArrayAccessible')
    ->validateAliases();

dataset('isArrayAccessible(passing)', [
    '([])'                  => [[]],
    '([1, 2, 3])'           => [[1, 2, 3]],
    '(new ArrayObject([]))' => [new ArrayObject([])],
]);
dataset('isArrayAccessible(failing)', [
    '(123)'            => [123, 'Expected an array or an object implementing ArrayAccess. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an array or an object implementing ArrayAccess. Got: stdClass (stdClass)'],
]);
