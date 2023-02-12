<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::equalTo(passing)')
    ->with('equalTo(passing)')
    ->expect(fn ($value, $expect) => Guard::equalTo(value: $value, expect: $expect))
    ->toHaveValueThat(assertionName: 'toBe', callable:  fn ($value, $expect) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::equalTo(failing)')
    ->expectInvalidArgumentException(fn ($value, $expect, $message) => $message)
    ->with('equalTo(failing)')
    ->expect(fn ($value, $expect, $message) => Guard::equalTo(value: $value, expect: $expect));

dataset('equalTo(passing)', [
    '(1, 1)'     => [1, 1],
    "(1, '1')"   => [1, '1'],
    '(1, true)'  => [1, true],
    '(0, false)' => [0, false],
]);
dataset('equalTo(failing)', [
    '(1, 2)'     => [1, 2, 'Expected a value equal to: 1 (int). Got: 2 (int)'],
    "(1, '2')"   => [1, '2', 'Expected a value equal to: 1 (int). Got: "2" (string)'],
    '(1, false)' => [1, false, 'Expected a value equal to: 1 (int). Got: false (bool)'],
]);
