<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isCountable(passing)', function ($value): void {
    expect(Guard::isCountable(value: $value))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '([])'                       => [[]],
    '([1, 2])'                   => [[1, 2]],
    '(new ArrayIterator())'      => [new ArrayIterator()],
    '(new ArrayIterator([])'     => [new ArrayIterator([])],
    'new \SimpleXMLElement(...)' => [new SimpleXMLElement('<foo>bar</foo>')],
]);

test('Guard::isCountable(failing)', function ($value, $message): void {
    expect(fn () => Guard::isCountable(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(new stdClass())' => [new stdClass(), 'Expected a countable value. Got: stdClass (stdClass)'],
    "('abcd')"         => ['abcd', 'Expected a countable value. Got: "abcd" (string)'],
    '(123)'            => [123, 'Expected a countable value. Got: 123 (int)'],
]);
