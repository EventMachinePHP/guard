<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isInstanceOfAny(passing)')
    ->with('isInstanceOfAny(passing)')
    ->expect(fn ($value, $classes) => Guard::isInstanceOfAny(value: $value, classes: $classes))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isInstanceOfAny(failing)')
    ->expectInvalidArgumentException(fn ($value, $classes, $message) => $message)
    ->with('isInstanceOfAny(failing)')
    ->expect(fn ($value, $classes, $message) => Guard::isInstanceOfAny(value: $value, classes: $classes));

dataset('isInstanceOfAny(passing)', [
    "(new ArrayIterator(), ['Iterator', 'ArrayAccess'])" => [new ArrayIterator(), ['Iterator', 'ArrayAccess']],
    "(new Exception(), ['Exception', 'Countable'])"      => [new Exception(), ['Exception', 'Countable']],
]);
dataset('isInstanceOfAny(failing)', [
    "(new Exception(), ['Exception', 'Countable'])" => [new Exception(), ['ArrayAccess', 'Countable'], 'Expected an instance of any of ArrayAccess, Countable. Got: Exception'],
    "(123, ['ArrayAccess', 'stdClass'])"            => [123, ['ArrayAccess', 'stdClass'], 'Expected an instance of any of ArrayAccess, stdClass. Got: 123 (int)'],
    "([], ['stdClass')"                             => [[], ['stdClass'], 'Expected an instance of any of stdClass. Got: array (array)'],
]);
