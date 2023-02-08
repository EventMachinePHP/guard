<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::integer ✅', function ($value): void {
    expect(Guard::integer(value: $value))
        ->toBe($value)
        ->toBeInt()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(123)' => [123],
]);

test('Guard::integer ❌', function ($value, $message): void {
    expect(fn () => Guard::integer(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "('123')"  => ['123', 'Expected an integer. Got: string'],
    '(12.34)'  => [12.34, 'Expected an integer. Got: float'],
    '(true)'   => [true, 'Expected an integer. Got: bool'],
    '(null)'   => [null, 'Expected an integer. Got: null'],
    '(array)'  => [[], 'Expected an integer. Got: array'],
    '(object)' => [new stdClass(), 'Expected an integer. Got: stdClass'],
]);
