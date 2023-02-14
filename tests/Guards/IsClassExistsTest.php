<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isClassExists(passing)')
    ->with('isClassExists(passing)')
    ->expect(fn ($value) => Guard::isClassExists(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->notToThrowInvalidArgumentException()
    ->and(fn ($value) => class_exists($value))
    ->toBeTrue();

test('Guard::isClassExists(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isClassExists(failing)')
    ->expect(fn ($value, $message) => Guard::isClassExists(value: $value));

test('Guard::isClassExists() Aliases')
    ->expect('isClassExists')
    ->validateAliases();

dataset('isClassExists(passing)', [
    '(Guard::class)' => [Guard::class],
]);
dataset('isClassExists(failing)', [
    "__NAMESPACE__.'\Foobar'" => [__NAMESPACE__.'\Foobar', 'Expected an existing class name. Got: "\Foobar" (string)'],
]);
