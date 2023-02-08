<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::boolean ✅', function ($value): void {
    expect(Guard::boolean(value: $value))
        ->toBe($value)
        ->toBeBool()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(true)'  => [true],
    '(false)' => [false],
]);

test('Guard::boolean ❌', function ($value, $message): void {
    expect(fn () => Guard::boolean(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1)'   => [1, 'Expected a boolean value. Got: 1 (int)'],
    "('1')" => ['1', 'Expected a boolean value. Got: "1" (string)'],
]);
