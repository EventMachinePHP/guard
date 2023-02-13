<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::isGreaterThan(passing)')
    ->with('isGreaterThan(passing)')
    ->expect(fn ($value, $limit) => Guard::isGreaterThan(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThan', callable: fn ($value, $limit) => $limit)
    ->notToThrowInvalidArgumentException();

test('Guard::isGreaterThan(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('isGreaterThan(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::isGreaterThan(value: $value, limit: $limit));

test('Guard::isGreaterThan() Aliases')
    ->expect('isGreaterThan')
    ->validateAliases();

dataset('isGreaterThan(passing)', [
    '(1, 0)' => [1, 0],
]);
dataset('isGreaterThan(failing)', [
    '(0, 1)' => [0, 1, 'Expected a value greater than: 1 (int). Got: 0 (int)'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
]);
