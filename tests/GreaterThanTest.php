<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::greaterThan(passing)')
    ->with('greaterThan(passing)')
    ->expect(fn ($value, $limit) => Guard::greaterThan(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThan', callable: fn ($value, $limit) => $limit)
    ->notToThrowInvalidArgumentException();

test('Guard::greaterThan(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('greaterThan(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::greaterThan(value: $value, limit: $limit));

dataset('greaterThan(passing)', [
    '(1, 0)' => [1, 0],
]);
dataset('greaterThan(failing)', [
    '(0, 1)' => [0, 1, 'Expected a value greater than: 1 (int). Got: 0 (int)'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
]);
