<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::notEqualTo(passing)', function ($value, $limit): void {
    expect(Guard::notEqualTo(value: $value, expect: $limit))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 2)'     => [1, 2],
    "(1, '2')"   => [1, '2'],
    '(1, false)' => [1, false],
]);

test('Guard::notEqualTo(failing)', function ($value, $limit, $message): void {
    expect(fn () => Guard::notEqualTo(value: $value, expect: $limit))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1, 1)'    => [1, 1, 'Expected a value different from: 1 (int). Got: 1 (int)'],
    "(1, '1')"  => [1, '1', 'Expected a value different from: 1 (int). Got: "1" (string)'],
    '(1, true)' => [1, true, 'Expected a value different from: 1 (int). Got: true (bool)'],
]);
