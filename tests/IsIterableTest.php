<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isIterable ✅', function ($value): void {
    expect(Guard::isIterable(value: $value))
        ->toBe($value)
        ->toBeIterable()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '([])'                        => [[]],
    '([1, 2, 3])'                 => [[1, 2, 3]],
    '(new ArrayIterator([1,2,3])' => [new ArrayIterator([1, 2, 3])],
]);

test('Guard::isIterable ❌', function ($value, $message): void {
    expect(fn () => Guard::isIterable(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(123)'            => [123, 'Expected an iterable. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an iterable. Got: stdClass (stdClass)'],
]);
