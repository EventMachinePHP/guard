<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::greaterThanOrEqual ✅', function ($value, $limit): void {
    expect(Guard::greaterThanOrEqual(value: $value, limit: $limit))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);

test('Guard::greaterThanOrEqual ❌', function ($value, $limit, $message): void {
    expect(fn () => Guard::greaterThanOrEqual(value: $value, limit: $limit))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);
