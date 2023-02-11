<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isArray(passing)', function ($value): void {
    expect(Guard::isArray(value: $value))
        ->toBe($value)
        ->toBeArray()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '([])'        => [[]],
    '([1, 2, 3])' => [[1, 2, 3]],
]);

test('Guard::isArray(failing)', function ($value, $message): void {
    expect(fn () => Guard::isArray(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(123'                        => [123, 'Expected an array. Got: 123 (int)'],
    '(new stdClass()'             => [new stdClass(), 'Expected an array. Got: stdClass (stdClass)'],
    '(new ArrayIterator(array())' => [new ArrayIterator([]), 'Expected an array. Got: ArrayIterator (ArrayIterator)'],
]);
