<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isNaturalInteger(passing)')
    ->with('isNaturalInteger(passing)')
    ->expect(fn ($value) => Guard::isNaturalInteger(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeInt()
    ->toBeGreaterThanOrEqual(0)
    ->notToThrowInvalidArgumentException();

test('Guard::isNaturalInteger(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isNaturalInteger(failing)')
    ->expect(fn ($value, $message) => Guard::isNaturalInteger(value: $value));

dataset('isNaturalInteger(passing)', [
    '(0)' => [0],
    '(1)' => [1],
]);
dataset('isNaturalInteger(failing)', [
    '(-1)'   => [-1, 'Expected a value greater than or equal to: 0 (int). Got: -1 (int)'],
    "('1')"  => ['1', 'Expected an integer. Got: string'],
    '(1.0)'  => [1.0, 'Expected an integer. Got: float'],
    '(1.23)' => [1.23, 'Expected an integer. Got: float'],
]);
