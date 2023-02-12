<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::lessThanOrEqual(passing)')
    ->with('lessThanOrEqual(passing)')
    ->expect(fn ($value, $limit) => Guard::lessThanOrEqual(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::lessThanOrEqual(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('lessThanOrEqual(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::lessThanOrEqual(value: $value, limit: $limit));

dataset('lessThanOrEqual(passing)', [
    '(0, 1)' => [0, 1],
    '(1, 1)' => [1, 1],
]);
dataset('lessThanOrEqual(failing)', [
    '(2, 1)' => [2, 1, 'Expected a value less than or equal to: 1 (int). Got: 2 (int)'],
]);
