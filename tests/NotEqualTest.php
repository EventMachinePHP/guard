<?php

use EventMachinePHP\Data\Guard;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

test('valid notEqualTo', function ($value, $other): void {
    expect(Guard::notEqualTo($value, $other))->toBe($value);
})->with([
    'integer vs integer'           => [1, 2],
    'integer vs integer as string' => [1, '2'],
    'integer vs boolean'           => [1, false],
]);

test('invalid notEqualTo', function ($value, $other): void {
    expect(Guard::notEqualTo($value, $other));
})->with([
    'integer vs integer'           => [1, 1],
    'integer vs integer as string' => [1, '1'],
    'integer vs boolean'           => [1, true],
])->throws(InvalidArgumentException::class);
