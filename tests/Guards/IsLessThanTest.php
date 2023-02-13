<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test('Guard::isLessThan(passing)')
    ->with('isLessThan(passing)')
    ->expect(fn ($value, $limit) => Guard::isLessThan(value: $value, limit: $limit))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $limit) => $value)
    ->toHaveValueThat(assertionName: 'toBeLessThan', callable: fn ($value, $limit) => $limit)
    ->notToThrowInvalidArgumentException();

test('Guard::isLessThan(failing)')
    ->expectInvalidArgumentException(fn ($value, $limit, $message) => $message)
    ->with('isLessThan(failing)')
    ->expect(fn ($value, $limit, $message) => Guard::isLessThan(value: $value, limit: $limit));

test('Guard::isLessThan() Aliases')
    ->expect('isLessThan')
    ->validateAliases();

dataset('isLessThan(passing)', [
    '(0, 1)' => [0, 1],
]);
dataset('isLessThan(failing)', [
    '(1, 1)' => [1, 1, 'Expected a value less than: 1 (int). Got: 1 (int)'],
]);
