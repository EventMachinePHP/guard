<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isFloat(passing)', function ($value): void {
    expect(Guard::isFloat(value: $value))
        ->toBe($value)
        ->toBeFloat()
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data: 'isFloat(passing)');

test('Guard::isFloat(failing)', function ($value, $message): void {
    expect(fn () => Guard::isFloat(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data: 'isFloat(failing)');

dataset('isFloat(passing)', [
    '(1.0)'  => [1.0],
    '(1.23)' => [1.23],
]);

dataset('isFloat(failing)', [
    '(123)'   => [123, 'Expected a float. Got: 123 (int)'],
    "('123')" => ['123', 'Expected a float. Got: "123" (string)'],
]);
