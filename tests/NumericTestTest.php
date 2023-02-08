<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::numeric ✅', function ($value): void {
    expect(Guard::numeric($value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1.0)'   => [1.0],
    '(1.23)'  => [1.23],
    '(123)'   => [123],
    "('123')" => ['123'],
]);

test('Guard::float ❌', function ($value, $message): void {
    expect(fn () => Guard::float($value))->toThrow(InvalidArgumentException::class, $message);
})->with([
    "('foo')" => ['foo', 'Expected a float. Got: "foo" (string)'],
]);
