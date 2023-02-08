<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::object ✅', function ($value): void {
    expect(Guard::object(value: $value))
        ->toBe($value)
        ->toBeObject()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(new stdClass())'         => [new stdClass()],
    '(new RuntimeException())' => [new RuntimeException()],
]);

test('Guard::object ❌', function ($value, $message): void {
    expect(fn () => Guard::object(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(null)' => [null, 'Expected an object. Got: null (null)'],
    '(true)' => [true, 'Expected an object. Got: true (bool)'],
    '(1)'    => [1, 'Expected an object. Got: 1 (int)'],
    '([])'   => [[], 'Expected an object. Got: array (array)'],
]);
