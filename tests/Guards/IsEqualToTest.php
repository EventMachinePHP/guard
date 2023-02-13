<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isEqualTo(passing)')
    ->with('isEqualTo(passing)')
    ->expect(fn ($value, $expect) => Guard::isEqualTo(value: $value, expect: $expect))
    ->toHaveValueThat(assertionName: 'toBe', callable:  fn ($value, $expect) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isEqualTo(failing)')
    ->expectInvalidArgumentException(fn ($value, $expect, $message) => $message)
    ->with('isEqualTo(failing)')
    ->expect(fn ($value, $expect, $message) => Guard::isEqualTo(value: $value, expect: $expect));

test('Guard::isEqualTo() Aliases')
    ->expect('isEqualTo')
    ->validateAliases();

dataset('isEqualTo(passing)', [
    '(1, 1)'     => [1, 1],
    "(1, '1')"   => [1, '1'],
    '(1, true)'  => [1, true],
    '(0, false)' => [0, false],
]);
dataset('isEqualTo(failing)', [
    '(1, 2)'     => [1, 2, 'Expected a value equal to: 1 (int). Got: 2 (int)'],
    "(1, '2')"   => [1, '2', 'Expected a value equal to: 1 (int). Got: "2" (string)'],
    '(1, false)' => [1, false, 'Expected a value equal to: 1 (int). Got: false (bool)'],
]);
