<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::notInstanceOf ✅', function ($value, $class): void {
    expect(Guard::notInstanceOf(value: $value, class: $class))
        ->toBe($value)
        ->not()->toBeInstanceOf($class)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass'],
    "(123, 'stdClass')"             => [123, 'stdClass'],
    "([], 'stdClass'')"             => [[], 'stdClass'],
]);

test('Guard::notInstanceOf ❌', function ($value, $class, $message): void {
    expect(fn () => Guard::notInstanceOf(value: $value, class: $class))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass', 'Expected a value not being an instance of stdClass. Got: stdClass (stdClass)'],
]);
