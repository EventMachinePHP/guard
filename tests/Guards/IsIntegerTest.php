<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isInteger(✅) ', function ($value): void {
    expect(Guard::isInteger(value: $value))
        ->toBe($value)
        ->toBeInt()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(23)' => [23],
    '(0)'  => [0],
    '(-1)' => [-1],
]);

test('Guard::isInteger(❌) ', function ($value, $message): void {
    expect(fn () => Guard::isInteger(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
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
    'resource (closed)'                        => [function () {
        $r = fopen('php://memory', 'r');
        fclose($r);

        return $r;
    }, 'Expected an integer. Got: resource (closed)'],
]);
