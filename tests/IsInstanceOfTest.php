<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isInstanceOf(passing)')
    ->with('isInstanceOf(passing)')
    ->expect(fn ($value, $class) => Guard::isInstanceOf(value: $value, class: $class))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toHaveValueThat(assertionName: 'toBeInstanceOf', callable: fn ($value, $class) => $class)
    ->notToThrowInvalidArgumentException();

test('Guard::isInstanceOf(failing)')
    ->expectInvalidArgumentException(fn ($value, $class, $message) => $message)
    ->with('isInstanceOf(failing)')
    ->expect(fn ($value, $class, $message) => Guard::isInstanceOf(value: $value, class: $class));

dataset('isInstanceOf(passing)', [
    "(new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass'],
]);
dataset('isInstanceOf(failing)', [
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass', 'Expected an instance of stdClass. Got: Exception'],
    '(123)'                         => [123, 'stdClass', 'Expected an instance of stdClass. Got: 123 (int)'],
    '([])'                          => [[], 'stdClass', 'Expected an instance of stdClass. Got: array (array)'],
    '(null)'                        => [null, 'stdClass', 'Expected an instance of stdClass. Got: null (null)'],
]);
