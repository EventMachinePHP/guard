<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::equalTo(passing)', function ($value, $other): void {
    expect(Guard::equalTo(value: $value, expect: $other))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 1)'    => [1, 1],
    "(1, '1')"  => [1, '1'],
    '(1, true)' => [1, true],
]);

test('Guard::equalTo(failing)', function ($value, $other, $message): void {
    expect(fn () => Guard::equalTo(value: $value, expect: $other))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 2)'     => [1, 2, 'Expected a value equal to: 1 (int). Got: 2 (int)'],
    "(1, '2')"   => [1, '2', 'Expected a value equal to: 1 (int). Got: "2" (string)'],
    '(1, false)' => [1, false, 'Expected a value equal to: 1 (int). Got: false (bool)'],
]);
