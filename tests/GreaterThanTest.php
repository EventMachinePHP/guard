<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::greaterThan ✅', function ($value, $other): void {
    expect(Guard::greaterThan($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 0)' => [1, 0],
]);

test('Guard::greaterThan ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::greaterThan($value, $other))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(0, 1)' => [0, 1, 'Expected a value greater than: 0. Got: 1'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0. Got: 0'],
]);