<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::lessThanOrEqual(passing)', function ($value, $limit): void {
    expect(Guard::lessThanOrEqual(value: $value, limit: $limit))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(0, 1)' => [0, 1],
    '(1, 1)' => [1, 1],
]);

test('Guard::lessThanOrEqual(failing)', function ($value, $limit, $message): void {
    expect(fn () => Guard::lessThanOrEqual(value: $value, limit: $limit))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(2, 1)' => [2, 1, 'Expected a value less than or equal to: 1 (int). Got: 2 (int)'],
]);
