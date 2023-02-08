<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::float ✅', function ($value): void {
    expect(Guard::float(value: $value))
        ->toBe($value)
        ->toBeFloat()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1.0)'  => [1.0],
    '(1.23)' => [1.23],
]);

test('Guard::float ❌', function ($value, $message): void {
    expect(fn () => Guard::float(value: $value))->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(123)'   => [123, 'Expected a float. Got: 123 (int)'],
    "('123')" => ['123', 'Expected a float. Got: "123" (string)'],
]);
