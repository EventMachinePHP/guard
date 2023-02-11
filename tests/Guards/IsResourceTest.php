<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isResource(passing)')
    ->with('isResource(passing)')
    ->expect(fn ($value, $type) => Guard::isResource(value: $value, type: $type))
    ->toHaveValue(fn ($value, $type) => $value)
    ->toBeResource()
    ->notToThrowInvalidArgumentException();

test('Guard::isResource(failing)')
    ->expectInvalidArgumentException(fn ($value, $type, $message) => $message)
    ->with('isResource(failing)')
    ->expect(fn ($value, $type, $message) => Guard::isResource(value: $value, type: $type));

test('Guard::isResource() Aliases')
    ->expect('isResource')
    ->validateAliases();

dataset('isResource(passing)', [
    '(fopen(,,))'           => [fopen('php://memory', 'r'), null],
    "(fopen(,,), 'stream')" => [fopen('php://memory', 'r'), 'stream'],
]);
dataset('isResource(failing)', [
    "(fopen(,,), 'other')" => [fopen('php://memory', 'r'), 'other', 'Expected a resource of type: other. Got: stream'],
    '(1)'                  => [1, null, 'Expected a resource. Got: 1 (int)'],
]);
