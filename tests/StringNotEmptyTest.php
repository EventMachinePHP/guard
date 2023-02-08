<?php

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::stringNotEmpty ✅', function ($value): void {
    expect(Guard::stringNotEmpty($value))
        ->toBe($value)
        ->toBeString()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);

test('Guard::stringNotEmpty ❌', function ($value, $message): void {
    expect(fn () => Guard::stringNotEmpty($value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "('')" => ['', 'Expected a value different from: "". Got: ""'],
    '(1)'  => [1, 'Expected a string. Got: int'],
]);
