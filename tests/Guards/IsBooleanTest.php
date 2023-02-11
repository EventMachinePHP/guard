<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isBoolean(passing)', function ($value): void {
    expect(Guard::isBoolean(value: $value))
        ->toBe($value)
        ->toBeBool()
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data: 'isBoolean(passing)');

test('Guard::isBoolean(failing)', function ($value, $message): void {
    expect(fn () => Guard::isBoolean(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data: 'isBoolean(failing)');

dataset('isBoolean(passing)', [
    '(true)'  => [true],
    '(false)' => [false],
]);

dataset('isBoolean(failing)', [
    '(1)'   => [1, 'Expected a boolean value. Got: 1 (int)'],
    "('1')" => ['1', 'Expected a boolean value. Got: "1" (string)'],
]);
