<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isString(passing)')
    ->with('isString(passing)')
    ->expect(fn ($value) => Guard::isString(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeString()
    ->notToThrowInvalidArgumentException();

test('Guard::isString(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isString(failing)')
    ->expect(fn ($value, $message) => Guard::isString(value: $value));

test('Guard::isString() Aliases')
    ->expect('isString')
    ->validateAliases();

dataset('isString(passing)', [
    "('abc')"  => ['abc'],
    "('23')"   => ['23'],
    "('23.5')" => ['23.5'],
    "('')"     => [''],
    "(' ')"    => [' '],
    "('0')"    => ['0'],
]);
dataset('isString(failing)', [
    '(true)'   => [true, 'Expected a string. Got: true (bool)'],
    '(false)'  => [false, 'Expected a string. Got: false (bool)'],
    '(null)'   => [null, 'Expected a string. Got: null (null)'],
    '(0)'      => [0, 'Expected a string. Got: 0 (int)'],
    '(23)'     => [23, 'Expected a string. Got: 23 (int)'],
    '(23.5)'   => [23.5, 'Expected a string. Got: 23.5 (float)'],
    '(array)'  => [[], 'Expected a string. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected a string. Got: stdClass'],
]);
