<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::isGreaterThanOrEqual(passing)')
    ->with('isGreaterThanOrEqual(passing)')
    ->expect(fn ($value, $limit) => Guard::isGreaterThanOrEqual(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThanOrEqual', callable: fn ($value, $limit) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isGreaterThanOrEqual(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('isGreaterThanOrEqual(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::isGreaterThanOrEqual(value: $value, limit: $limit));

test('Guard::isGreaterThanOrEqual() Aliases')
    ->expect('isGreaterThanOrEqual')
    ->validateAliases();

dataset('isGreaterThanOrEqual(passing)', [
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);
dataset('isGreaterThanOrEqual(failing)', [
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);
