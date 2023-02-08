<?php

use EventMachinePHP\Data\Guard;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

test('valid string', function ($value): void {
    expect(Guard::string($value))
        ->toBeString()
        ->toBe($value);
})->with([
    'string value' => 'value',
    'empty string' => '',
]);

test('invalid string', function ($value): void {
    expect(Guard::string($value));
})->with([
    'integer' => 1234,
    'float'   => 12.34,
    'boolean' => true,
    'null'    => null,
    'array'   => [[]],
    'object'  => new stdClass(),
])->throws(InvalidArgumentException::class);
