<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::equalTo ✅', function ($value, $other): void {
    expect(Guard::equalTo($value, $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 1)'    => [1, 1],
    "(1, '1')"  => [1, '1'],
    '(1, true)' => [1, true],
]);

test('Guard::equalTo ❌', function ($value, $other, $message): void {
    expect(fn () => Guard::equalTo($value, $other))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 2)'     => [1, 2, 'Expected a value equal to: 1. Got: 2'],
    "(1, '2')"   => [1, '2', 'Expected a value equal to: 1. Got: "2'],
    '(1, false)' => [1, false, 'Expected a value equal to: 1. Got: false'],
]);
