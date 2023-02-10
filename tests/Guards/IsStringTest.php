<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isString ✅', function ($value): void {
    expect(Guard::isString(value: $value))
        ->toBe($value)
        ->toBeString()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "('abc')"  => ['abc'],
    "('23')"   => ['23'],
    "('23.5')" => ['23.5'],
    "('')"     => [''],
    "(' ')"    => [' '],
    "('0')"    => ['0'],
]);

test('Guard::isString ❌', function ($value, $message): void {
    expect(fn () => Guard::isString(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(true)'   => [true, 'Expected a string. Got: true (bool)'],
    '(false)'  => [false, 'Expected a string. Got: false (bool)'],
    '(null)'   => [null, 'Expected a string. Got: null (null)'],
    '(0)'      => [0, 'Expected a string. Got: 0 (int)'],
    '(23)'     => [23, 'Expected a string. Got: 23 (int)'],
    '(23.5)'   => [23.5, 'Expected a string. Got: 23.5 (float)'],
    '(array)'  => [[], 'Expected a string. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected a string. Got: stdClass'],
]);
