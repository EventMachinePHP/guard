<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::integerish ✅', function ($value): void {
    expect(Guard::integerish($value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(123)'  => [123],
    '(1.0)'  => [1.0],
    "('123)" => ['123'],
]);

test('Guard::integerish ❌', function ($value, $message): void {
    expect(fn () => Guard::integerish($value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(12.34)'  => [12.34, 'Expected an integerish value. Got: 12.34'],
    '(true)'   => [true, 'Expected an integerish value. Got: true'],
    '(null)'   => [null, 'Expected an integerish value. Got: null'],
    '(array)'  => [[], 'Expected an integerish value. Got: array'],
    '(object)' => [new stdClass(), 'Expected an integerish value. Got: stdClass'],
]);