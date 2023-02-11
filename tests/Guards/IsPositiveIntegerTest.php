<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isPositiveInteger(passing)', function ($value): void {
    expect(Guard::isPositiveInteger(value: $value))
        ->toBe($value)
        ->toBeInt()
        ->toBeGreaterThan(0)
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data: 'isPositiveInteger(passing)');

test('Guard::isPositiveInteger(failing)', function ($value, $message): void {
    expect(fn () => Guard::isPositiveInteger(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data:'isPositiveInteger(failing)');

dataset('isPositiveInteger(passing)', [
    '(123)' => [123],
    '(1)'   => [1],
]);

dataset('isPositiveInteger(failing)', [
    '(-123)'   => [-123, 'Expected a value greater than: 0 (int). Got: -123 (int)'],
    '(0)'      => [0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
    '(0.0)'    => [0.0, 'Expected an integer. Got: float'],
    "('123')"  => ['123', 'Expected an integer. Got: string'],
    "('-123')" => ['-123', 'Expected an integer. Got: string'],
    "('0')"    => ['0', 'Expected an integer. Got: string'],
    '(1.0)'    => [1.0, 'Expected an integer. Got: float'],
    '(1.23)'   => [1.23, 'Expected an integer. Got: float'],
]);
