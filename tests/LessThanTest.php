<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::lessThan(passing)')
    ->with('lessThan(passing)')
    ->expect(fn ($value, $limit) => Guard::lessThan(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeLessThan', callable: fn ($value, $limit) => $limit)
    ->notToThrowInvalidArgumentException();

test('Guard::lessThan(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('lessThan(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::lessThan(value: $value, limit: $limit));

dataset('lessThan(passing)', [
    '(0, 1)' => [0, 1],
]);
dataset('lessThan(failing)', [
    '(1, 1)' => [1, 1, 'Expected a value less than: 1 (int). Got: 1 (int)'],
]);
