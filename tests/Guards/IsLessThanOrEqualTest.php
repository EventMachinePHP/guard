<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::isLessThanOrEqual(passing)')
    ->with('isLessThanOrEqual(passing)')
    ->expect(fn ($value, $limit) => Guard::isLessThanOrEqual(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isLessThanOrEqual(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('isLessThanOrEqual(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::isLessThanOrEqual(value: $value, limit: $limit));

test('Guard::isLessThanOrEqual() Aliases')
    ->expect('isLessThanOrEqual')
    ->validateAliases();

dataset('isLessThanOrEqual(passing)', [
    '(0, 1)' => [0, 1],
    '(1, 1)' => [1, 1],
]);
dataset('isLessThanOrEqual(failing)', [
    '(2, 1)' => [2, 1, 'Expected a value less than or equal to: 1 (int). Got: 2 (int)'],
]);
