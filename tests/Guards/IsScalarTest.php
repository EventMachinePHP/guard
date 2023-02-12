<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isScalar(passing)')
    ->with('isScalar(passing)')
    ->expect(fn ($value) => Guard::isScalar(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeScalar()
    ->notToThrowInvalidArgumentException();

test('Guard::isScalar(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isScalar(failing)')
    ->expect(fn ($value, $message) => Guard::isScalar(value: $value));

test('Guard::isScalar() Aliases')
    ->expect('isScalar')
    ->validateAliases();

dataset('isScalar(passing)', [
    "('1')"  => ['1'],
    '(123)'  => [123],
    '(true)' => [true],
]);
dataset('isScalar(failing)', [
    '(null)'           => [null, 'Expected a scalar value. Got: null (null)'],
    '([])'             => [[], 'Expected a scalar value. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected a scalar value. Got: stdClass (stdClass)'],
]);
