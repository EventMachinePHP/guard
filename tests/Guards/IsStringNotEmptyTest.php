<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::stringNotEmpty(passing)', function ($value): void {
    expect(Guard::stringNotEmpty(value: $value))
        ->toBe($value)
        ->toBeString()
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data:'stringNotEmpty(passing)');

test('Guard::stringNotEmpty(failing)', function ($value, $message): void {
    expect(fn () => Guard::stringNotEmpty(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data:'stringNotEmpty(failing)');

dataset('stringNotEmpty(passing)', [
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);

dataset('stringNotEmpty(failing)', [
    "('')" => ['', 'Expected a value different from: "" (string). Got: "" (string)'],
    '(1)'  => [1, 'Expected a string. Got: 1 (int)'],
]);


