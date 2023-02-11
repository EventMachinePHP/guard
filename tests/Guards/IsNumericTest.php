<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isNumeric(passing)', function ($value): void {
    expect(Guard::isNumeric(value: $value))
        ->toBe($value)
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data: 'isNumeric(passing)');

test('Guard::isNumeric(failing)', function ($value, $message): void {
    expect(fn () => Guard::isNumeric(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data: 'isNumeric(failing)');

dataset('isNumeric(passing)', [
    '(1.0)'   => [1.0],
    '(1.23)'  => [1.23],
    '(123)'   => [123],
    "('123')" => ['123'],
]);

dataset('isNumeric(failing)', [
    "('foo')" => ['foo', 'Expected a numeric value. Got: "foo" (string)'],
]);
