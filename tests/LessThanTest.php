<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::lessThan ✅', function ($value, $limit): void {
    expect(Guard::lessThan(value: $value, limit: $limit))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(0, 1)' => [0, 1],
]);

test('Guard::lessThan ❌', function ($value, $limit, $message): void {
    expect(fn () => Guard::lessThan(value: $value, limit: $limit))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 1)' => [1, 1, 'Expected a value less than: 1 (int). Got: 1 (int)'],
]);
