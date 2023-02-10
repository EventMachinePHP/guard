<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::stringNotEmpty(✅) ', function ($value): void {
    expect(Guard::stringNotEmpty(value: $value))
        ->toBe($value)
        ->toBeString()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);

test('Guard::stringNotEmpty(❌) ', function ($value, $message): void {
    expect(fn () => Guard::stringNotEmpty(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "('')" => ['', 'Expected a value different from: "" (string). Got: "" (string)'],
    '(1)'  => [1, 'Expected a string. Got: 1 (int)'],
]);
