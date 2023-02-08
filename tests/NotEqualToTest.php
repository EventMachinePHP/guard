<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::notEqualTo ✅', function ($value, $other): void {
    expect(Guard::notEqualTo($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 2)'     => [1, 2],
    "(1, '2')"   => [1, '2'],
    '(1, false)' => [1, false],
]);

test('Guard::notEqualTo ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::notEqualTo($value, $other))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 1)'    => [1, 1, 'Expected a value different from: 1. Got: 1'],
    "(1, '1')"  => [1, '1', 'Expected a value different from: 1. Got: "1"'],
    '(1, true)' => [1, true, 'Expected a value different from: 1. Got: true'],
]);
