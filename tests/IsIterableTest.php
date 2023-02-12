<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isIterable(passing)')
    ->with('isIterable(passing)')
    ->expect(fn ($value) => Guard::isIterable(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeIterable()
    ->notToThrowInvalidArgumentException();

test('Guard::isIterable(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isIterable(failing)')
    ->expect(fn ($value, $message) => Guard::isIterable(value: $value));

dataset('isIterable(passing)', [
    '([])'                        => [[]],
    '([1, 2, 3])'                 => [[1, 2, 3]],
    '(new ArrayIterator([1,2,3])' => [new ArrayIterator([1, 2, 3])],
]);
dataset('isIterable(failing)', [
    '(123)'            => [123, 'Expected an iterable. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an iterable. Got: stdClass (stdClass)'],
]);
