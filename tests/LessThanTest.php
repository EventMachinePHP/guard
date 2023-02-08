<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::lessThan ✅', function ($value, $other): void {
    expect(Guard::lessThan($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(0, 1)' => [0, 1],
]);

/* @see \EventMachinePHP\Guard\Guard::greaterThan() */
test('Guard::lessThan ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::lessThan($value, $other))->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 1)' => [1, 1, 'Expected a value less than: 1 (int). Got: 1 (int)'],
]);
