<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::notInstanceOf(passing)')
    ->with('notInstanceOf(passing)')
    ->expect(fn ($value, $class) => Guard::notInstanceOf(value: $value, class: $class))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $class) => $value)
    ->not()->toHaveValueThat(assertionName: 'toBeInstanceOf', callable: fn ($value, $class) => $class)
    ->notToThrowInvalidArgumentException();

test('Guard::notInstanceOf(failing)')
    ->expectInvalidArgumentException(fn ($value, $class, $message) => $message)
    ->with('notInstanceOf(failing)')
    ->expect(fn ($value, $class, $message) => Guard::notInstanceOf(value: $value, class: $class));

dataset('notInstanceOf(passing)', [
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass'],
    "(123, 'stdClass')"             => [123, 'stdClass'],
    "([], 'stdClass'')"             => [[], 'stdClass'],
]);
dataset('notInstanceOf(failing)', [
    "new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass', 'Expected a value not being an instance of stdClass. Got: stdClass (stdClass)'],
]);
