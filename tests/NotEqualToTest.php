<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::notEqualTo(passing)')
    ->with('notEqualTo(passing)')
    ->expect(fn ($value, $expect) => Guard::notEqualTo(value: $value, expect: $expect))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $expect) => $value)
    ->not()->toHaveValueThat(assertionName: 'toEqual', callable: fn ($value, $expect) => $expect)
    ->notToThrowInvalidArgumentException();

test('Guard::notEqualTo(failing)')
    ->expectInvalidArgumentException(fn ($value, $expect, $message) => $message)
    ->with('notEqualTo(failing)')
    ->expect(fn ($value, $expect, $message) => Guard::notEqualTo(value: $value, expect: $expect));

dataset('notEqualTo(passing)', [
    '(1, 2)'     => [1, 2],
    "(1, '2')"   => [1, '2'],
    '(1, false)' => [1, false],
]);
dataset('notEqualTo(failing)', [
    '(1, 1)'    => [1, 1, 'Expected a value different from: 1 (int). Got: 1 (int)'],
    "(1, '1')"  => [1, '1', 'Expected a value different from: 1 (int). Got: "1" (string)'],
    '(1, true)' => [1, true, 'Expected a value different from: 1 (int). Got: true (bool)'],
]);
