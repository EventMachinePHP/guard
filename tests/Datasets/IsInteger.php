<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1337)'  => [1337],
    '(1)'     => [1],
    '(0)'     => [0],
    '(2)'     => [2],
    '(-1337)' => [-1337],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(null)'                                   => [null, 'Expected an integer. Got: null'],
    '(true)'                                   => [true, 'Expected an integer. Got: bool'],
    '(false)'                                  => [false, 'Expected an integer. Got: bool'],
    '(1337.43057)'                             => [1337.43057, 'Expected an integer. Got: float'],
    '(1.0)'                                    => [1.0, 'Expected an integer. Got: float'],
    '(0.0)'                                    => [0.0, 'Expected an integer. Got: float'],
    '(-1.0)'                                   => [-0.0, 'Expected an integer. Got: float'],
    '(-1337.43057)'                            => [-1337.43057, 'Expected an integer. Got: float'],
    "('')"                                     => ['', 'Expected an integer. Got: string'],
    "(' ')"                                    => [' ', 'Expected an integer. Got: string'],
    "('  ')"                                   => ['  ', 'Expected an integer. Got: string'],
    "('B1ff')"                                 => ['B1ff', 'Expected an integer. Got: string'],
    "('-23')"                                  => ['-23', 'Expected an integer. Got: string'],
    "('0')"                                    => ['0', 'Expected an integer. Got: string'],
    "('23')"                                   => ['23', 'Expected an integer. Got: string'],
    "('23.5')"                                 => ['23.5', 'Expected an integer. Got: string'],
    "('-23.5')"                                => ['-23.5', 'Expected an integer. Got: string'],
    '([])'                                     => [[], 'Expected an integer. Got: array'],
    '([null])'                                 => [[null], 'Expected an integer. Got: array'],
    '([1, 2, 3])'                              => [[1, 2, 3], 'Expected an integer. Got: array'],
    '(fn (): Closure => function (): void {})' => [fn (): Closure => function (): void {}, 'Expected an integer. Got: Closure'],
    '(new stdClass())'                         => [new stdClass(), 'Expected an integer. Got: stdClass'],
    '(new class {})'                           => [new class {}, 'Expected an integer. Got: class@anonymous'],
    '(new Exception())'                        => [new Exception(), 'Expected an integer. Got: Exception'],
    'resource (stream)'                        => [fopen('php://memory', 'r'), 'Expected an integer. Got: resource (stream)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
