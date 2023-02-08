<?php

use EventMachinePHP\Data\Guard;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

test('valid equalTo', function ($value, $other): void {
    expect(Guard::equalTo($value, $other))->toBe($value);
})->with([
    'integer vs integer'           => [1, 1],
    'integer vs integer as string' => [1, '1'],
    'integer vs boolean'           => [1, true],
]);

test('invalid equalTo', function ($value, $other): void {
    expect(Guard::equalTo($value, $other));
})->with([
    'integer vs integer'           => [1, 2],
    'integer vs integer as string' => [1, '2'],
    'integer vs boolean'           => [1, false],
])->throws(InvalidArgumentException::class);
