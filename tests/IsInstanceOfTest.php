<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isInstanceOf(passing)', function ($value, $class): void {
    expect(Guard::isInstanceOf(value: $value, class: $class))
        ->toBe($value)
        ->toBeInstanceOf($class)
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    "(new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass'],
]);

test('Guard::isInstanceOf(failing)', function ($value, $class, $message): void {
    expect(fn () => Guard::isInstanceOf(value: $value, class: $class))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass', 'Expected an instance of stdClass. Got: Exception'],
    '(123)'                         => [123, 'stdClass', 'Expected an instance of stdClass. Got: 123 (int)'],
    '([])'                          => [[], 'stdClass', 'Expected an instance of stdClass. Got: array (array)'],
    '(null)'                        => [null, 'stdClass', 'Expected an instance of stdClass. Got: null (null)'],
]);
