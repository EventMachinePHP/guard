<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::lessThanOrEqual ✅', function ($value, $other): void {
    expect(Guard::lessThanOrEqual($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(0, 1)' => [0, 1],
    '(1, 1)' => [1, 1],
]);

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::lessThanOrEqual ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::lessThanOrEqual($value, $other))->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(2, 1)' => [2, 1, 'Expected a value less than or equal to: 1 (int). Got: 2 (int)'],
]);
