<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isInteger(passing)')
    ->with('isInteger(passing)')
    ->expect(fn ($value) => Guard::isInteger(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeInt()
    ->notToThrowInvalidArgumentException();

test('Guard::isInteger(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isInteger(failing)')
    ->expect(fn ($value) => Guard::isInteger(value: $value));

test('Guard::isInteger() Aliases')
    ->expect('isInteger')
    ->validateAliases();

dataset('isInteger(passing)', [
    '(23)' => [23],
    '(0)'  => [0],
    '(-1)' => [-1],
]);
dataset('isInteger(failing)', [
    '(null)'                                   => [null, 'Expected an integer. Got: null'],
    '(true)'                                   => [true, 'Expected an integer. Got: bool'],
    '(false)'                                  => [false, 'Expected an integer. Got: bool'],
    "('-23')"                                  => ['-23', 'Expected an integer. Got: string'],
    "('0')"                                    => ['0', 'Expected an integer. Got: string'],
    "('23')"                                   => ['23', 'Expected an integer. Got: string'],
    "('23.5')"                                 => ['23.5', 'Expected an integer. Got: string'],
    "('-23.5')"                                => ['-23.5', 'Expected an integer. Got: string'],
    '(23.5)'                                   => [23.5, 'Expected an integer. Got: float'],
    '(0.0)'                                    => [0.0, 'Expected an integer. Got: float'],
    '(-23.5)'                                  => [-23.5, 'Expected an integer. Got: float'],
    '([])'                                     => [[], 'Expected an integer. Got: array'],
    '([1, 2, 3])'                              => [[1, 2, 3], 'Expected an integer. Got: array'],
    '(fn (): Closure => function (): void {})' => [fn (): Closure => function (): void {}, 'Expected an integer. Got: Closure'],
    '(new stdClass())'                         => [new stdClass(), 'Expected an integer. Got: stdClass'],
    '(new class {})'                           => [new class {}, 'Expected an integer. Got: class@anonymous'],
    '(new Exception())'                        => [new Exception(), 'Expected an integer. Got: Exception'],
    'resource (stream)'                        => [fopen('php://memory', 'r'), 'Expected an integer. Got: resource (stream)'],
]);
