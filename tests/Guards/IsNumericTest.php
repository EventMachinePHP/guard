<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isNumeric(✅) ', function ($value): void {
    expect(Guard::isNumeric(value: $value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1.0)'   => [1.0],
    '(1.23)'  => [1.23],
    '(123)'   => [123],
    "('123')" => ['123'],
]);

test('Guard::isNumeric(❌) ', function ($value, $message): void {
    expect(fn () => Guard::isNumeric(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "('foo')" => ['foo', 'Expected a numeric value. Got: "foo" (string)'],
]);
