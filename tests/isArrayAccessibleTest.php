<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isArrayAccessible(passing)', function ($value): void {
    expect(Guard::isArrayAccessible(value: $value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '([])'                  => [[]],
    '([1, 2, 3])'           => [[1, 2, 3]],
    '(new ArrayObject([]))' => [new ArrayObject([])],
]);

test('Guard::isArrayAccessible(failing)', function ($value, $message): void {
    expect(fn () => Guard::isArrayAccessible(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(123)'            => [123, 'Expected an array or an object implementing ArrayAccess. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an array or an object implementing ArrayAccess. Got: stdClass (stdClass)'],
]);
