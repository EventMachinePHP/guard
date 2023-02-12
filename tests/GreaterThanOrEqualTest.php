<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::greaterThanOrEqual(passing)')
    ->with('greaterThanOrEqual(passing)')
    ->expect(fn ($value, $limit) => Guard::greaterThanOrEqual(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThanOrEqual', callable: fn ($value, $limit) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::greaterThanOrEqual(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('greaterThanOrEqual(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::greaterThanOrEqual(value: $value, limit: $limit));

dataset('greaterThanOrEqual(passing)', [
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);
dataset('greaterThanOrEqual(failing)', [
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);
