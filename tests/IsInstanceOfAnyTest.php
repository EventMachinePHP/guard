<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isInstanceOfAny(passing)', function ($value, $classes): void {
    expect(Guard::isInstanceOfAny(value: $value, classes: $classes))
        ->toBe($value)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "(new ArrayIterator(), ['Iterator', 'ArrayAccess'])" => [new ArrayIterator(), ['Iterator', 'ArrayAccess']],
    "(new Exception(), ['Exception', 'Countable'])"      => [new Exception(), ['Exception', 'Countable']],
]);

test('Guard::isInstanceOfAny(failing)', function ($value, $classes, $message): void {
    expect(fn () => Guard::isInstanceOfAny(value: $value, classes: $classes))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "(new Exception(), ['Exception', 'Countable'])" => [new Exception(), ['ArrayAccess', 'Countable'], 'Expected an instance of any of ArrayAccess, Countable. Got: Exception'],
    "(123, ['ArrayAccess', 'stdClass'])"            => [123, ['ArrayAccess', 'stdClass'], 'Expected an instance of any of ArrayAccess, stdClass. Got: 123 (int)'],
    "([], ['stdClass')"                             => [[], ['stdClass'], 'Expected an instance of any of stdClass. Got: array (array)'],
]);
