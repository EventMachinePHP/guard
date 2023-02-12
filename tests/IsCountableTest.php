<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isCountable(passing)')
    ->with('isCountable(passing)')
    ->expect(fn ($value) => Guard::isCountable(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isCountable(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isCountable(failing)')
    ->expect(fn ($value, $message) => Guard::isCountable(value: $value));

dataset('isCountable(passing)', [
    '([])'                       => [[]],
    '([1, 2])'                   => [[1, 2]],
    '(new ArrayIterator())'      => [new ArrayIterator()],
    '(new ArrayIterator([])'     => [new ArrayIterator([])],
    'new \SimpleXMLElement(...)' => [new SimpleXMLElement('<foo>bar</foo>')],
]);
dataset('isCountable(failing)', [
    '(new stdClass())' => [new stdClass(), 'Expected a countable value. Got: stdClass (stdClass)'],
    "('abcd')"         => ['abcd', 'Expected a countable value. Got: "abcd" (string)'],
    '(123)'            => [123, 'Expected a countable value. Got: 123 (int)'],
]);
