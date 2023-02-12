<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('Guard::isCallable(passing)', function ($value): void {
    expect(Guard::isCallable(value: $value))
        ->toBe($value)
        ->toBeCallable()
        ->not()->toThrow(InvalidArgumentException::class);
})->with([
    '(strlen)'                                 => ['strlen'],
    '(fn (): Closure => function (): void {})' => [fn (): Closure => function (): void {}],
]);

test('Guard::isCallable(failing)', function ($value, $message): void {
    expect(fn () => Guard::isCallable(value: $value))
        ->toThrow(InvalidArgumentException::class, $message);
})->with([
    '(1234)'  => [1234, 'Expected a callable. Got: 1234 (int)'],
    "('foo')" => ['foo', 'Expected a callable. Got: "foo" (string)'],
]);
