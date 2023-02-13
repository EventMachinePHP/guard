<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isNotInstanceOf(passing)')
    ->with('isNotInstanceOf(passing)')
    ->expect(fn ($value, $class) => Guard::isNotInstanceOf(value: $value, class: $class))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $class) => $value)
    ->not()->toHaveValueThat(assertionName: 'toBeInstanceOf', callable: fn ($value, $class) => $class)
    ->notToThrowInvalidArgumentException();

test('Guard::isNotInstanceOf(failing)')
    ->expectInvalidArgumentException(fn ($value, $class, $message) => $message)
    ->with('isNotInstanceOf(failing)')
    ->expect(fn ($value, $class, $message) => Guard::isNotInstanceOf(value: $value, class: $class));

test('Guard::isNotInstanceOf() Aliases')
    ->expect('isNotInstanceOf')
    ->validateAliases();

dataset('isNotInstanceOf(passing)', [
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass'],
    "(123, 'stdClass')"             => [123, 'stdClass'],
    "([], 'stdClass'')"             => [[], 'stdClass'],
]);
dataset('isNotInstanceOf(failing)', [
    "new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass', 'Expected a value not being an instance of stdClass. Got: stdClass (stdClass)'],
]);
