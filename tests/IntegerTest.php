<?php

use EventMachinePHP\Data\Guard;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

test('valid integer', function ($value): void {
    expect(Guard::integer($value))
        ->toBeInt()
        ->toBe($value);
})->with([
    'integer value' => 123,
]);

test('invalid integer', function ($value): void {
    expect(Guard::integer($value));
})->with([
    'integer string' => '123',
    'float'          => 12.34,
    'boolean'        => true,
    'null'           => null,
    'array'          => [[]],
    'object'         => new stdClass(),
])->throws(InvalidArgumentException::class);
