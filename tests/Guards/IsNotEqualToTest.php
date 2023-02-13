<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::IsNotEqualTo(passing)')
    ->with('IsNotEqualTo(passing)')
    ->expect(fn ($value, $expect) => Guard::IsNotEqualTo(value: $value, expect: $expect))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $expect) => $value)
    ->not()->toHaveValueThat(assertionName: 'toEqual', callable: fn ($value, $expect) => $expect)
    ->notToThrowInvalidArgumentException();

test('Guard::IsNotEqualTo(failing)')
    ->expectInvalidArgumentException(fn ($value, $expect, $message) => $message)
    ->with('IsNotEqualTo(failing)')
    ->expect(fn ($value, $expect, $message) => Guard::IsNotEqualTo(value: $value, expect: $expect));

test('Guard::IsNotEqualTo() Aliases')
    ->expect('IsNotEqualTo')
    ->validateAliases();

dataset('IsNotEqualTo(passing)', [
    '(1, 2)'     => [1, 2],
    "(1, '2')"   => [1, '2'],
    '(1, false)' => [1, false],
]);
dataset('IsNotEqualTo(failing)', [
    '(1, 1)'    => [1, 1, 'Expected a value different from: 1 (int). Got: 1 (int)'],
    "(1, '1')"  => [1, '1', 'Expected a value different from: 1 (int). Got: "1" (string)'],
    '(1, true)' => [1, true, 'Expected a value different from: 1 (int). Got: true (bool)'],
]);
