<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isObject(passing)', function ($value): void {
    expect(Guard::isObject(value: $value))
        ->toBe($value)
        ->toBeObject()
        ->not()->toThrow(exception: InvalidArgumentException::class);
})->with(data:'isObject(passing)');

test('Guard::isObject(failing)', function ($value, $message): void {
    expect(fn () => Guard::isObject(value: $value))
        ->toThrow(exception: InvalidArgumentException::class, exceptionMessage: $message);
})->with(data: 'isObject(failing)');

dataset('isObject(passing)', [
    '(new stdClass())'         => [new stdClass()],
    '(new RuntimeException())' => [new RuntimeException()],
]);

dataset('isObject(failing)', [
    '(null)' => [null, 'Expected an object. Got: null (null)'],
    '(true)' => [true, 'Expected an object. Got: true (bool)'],
    '(1)'    => [1, 'Expected an object. Got: 1 (int)'],
    '([])'   => [[], 'Expected an object. Got: array (array)'],
]);
