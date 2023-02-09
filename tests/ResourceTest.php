<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

afterEach(function (): void {
    gc_collect_cycles();
});

test('Guard::resource ✅', function ($value, $type): void {
    expect(Guard::resource(value: $value, type: $type))
        ->toBe($value)
        ->toBeResource()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(fopen(,,))'           => [fopen('php://memory', 'r'), null],
    "(fopen(,,), 'stream')" => [fopen('php://memory', 'r'), 'stream'],
]);

test('Guard::resource ❌', function ($value, $type, $message): void {
    expect(fn () => Guard::resource(value: $value, type: $type))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "(fopen(,,), 'other')" => [fopen('php://memory', 'r'), 'other', 'Expected a resource of type: other. Got: stream'],
    '(1)'                  => [1, null, 'Expected a resource. Got: 1 (int)'],
]);
