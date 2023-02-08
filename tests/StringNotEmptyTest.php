<?php

use EventMachinePHP\Data\Guard;
use EventMachinePHP\Data\Exceptions\InvalidArgumentException;

test('valid stringNotEmpty', function ($value): void {
    expect(Guard::stringNotEmpty($value))
        ->toBeString()
        ->toBe($value);
})->with([
    'non empty value I'    => 'value',
    'non empty value I II' => '0',
]);

test('invalid stringNotEmpty', function ($value): void {
    expect(Guard::stringNotEmpty($value));
})->with([
    'empty string' => '',
    'integer'      => 1,
])->throws(InvalidArgumentException::class);
