<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::greaterThan(passing)', function ($value, $limit): void {
    expect(Guard::greaterThan(value: $value, limit: $limit))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(1, 0)' => [1, 0],
]);

test('Guard::greaterThan(failing)', function ($value, $limit, $message): void {
    expect(fn () => Guard::greaterThan(value: $value, limit: $limit))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(0, 1)' => [0, 1, 'Expected a value greater than: 1 (int). Got: 0 (int)'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
]);
