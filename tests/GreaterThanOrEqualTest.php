<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::greaterThanOrEqual ✅', function ($value, $other): void {
    expect(Guard::greaterThanOrEqual($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::greaterThanOrEqual ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::greaterThanOrEqual($value, $other))->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);
