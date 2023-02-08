<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::string ✅', function ($value): void {
    expect(Guard::string($value))
        ->toBe($value)
        ->toBeString()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "('value')" => ['value'],
    "('')"      => [''],
]);

test('Guard::string ❌', function ($value, $message): void {
    expect(fn () => Guard::string($value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1234)'   => [1234, 'Expected a string. Got: int'],
    '(12.34)'  => [12.23, 'Expected a string. Got: float'],
    '(true)'   => [true, 'Expected a string. Got: bool'],
    '(null)'   => [null, 'Expected a string. Got: null'],
    '(array)'  => [[], 'Expected a string. Got: array'],
    '(object)' => [new stdClass(), 'Expected a string. Got: stdClass'],
]);
