<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isIntegerValue ✅', function ($value): void {
    expect(Guard::isIntegerValue(value: $value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(123)'   => [123],
    '(1.0)'   => [1.0],
    "('123')" => ['123'],
]);

test('Guard::isIntegerValue ❌', function ($value, $message): void {
    expect(fn () => Guard::isIntegerValue(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(12.34)'  => [12.34, 'Expected an isIntegerValue value. Got: 12.34 (float)'],
    '(true)'   => [true, 'Expected an isIntegerValue value. Got: true (bool)'],
    '(null)'   => [null, 'Expected an isIntegerValue value. Got: null (null)'],
    '(array)'  => [[], 'Expected an isIntegerValue value. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected an isIntegerValue value. Got: stdClass (stdClass)'],
]);
