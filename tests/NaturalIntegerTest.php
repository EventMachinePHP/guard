<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isNaturalInteger(passing)', function ($value): void {
    expect(Guard::isNaturalInteger(value: $value))
        ->toBe($value)
        ->toBeInt()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(0)' => [0],
    '(1)' => [1],
]);

test('Guard::isNaturalInteger(failing)', function ($value, $message): void {
    expect(fn () => Guard::isNaturalInteger(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(-1)'   => [-1, 'Expected a value greater than or equal to: 0 (int). Got: -1 (int)'],
    "('1')"  => ['1', 'Expected an integer. Got: string'],
    '(1.0)'  => [1.0, 'Expected an integer. Got: float'],
    '(1.23)' => [1.23, 'Expected an integer. Got: float'],
]);
