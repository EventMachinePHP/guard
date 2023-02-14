<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isIdenticalTo(passing)')
    ->with('isIdenticalTo(passing)')
    ->expect(fn ($value, $expect) => Guard::isIdenticalTo(value: $value, expect: $expect))
    ->toHaveValueThat(assertionName: 'toBe', callable:  fn ($value, $expect) => $value)
    ->notToThrowInvalidArgumentException();

test('Guard::isIdenticalTo(failing)')
    ->expectInvalidArgumentException(fn ($value, $expect, $message) => $message)
    ->with('isIdenticalTo(failing)')
    ->expect(fn ($value, $expect, $message) => Guard::isIdenticalTo(value: $value, expect: $expect));

test('Guard::isIdenticalTo() Aliases')
    ->expect('isIdenticalTo')
    ->validateAliases();

dataset('isIdenticalTo(passing)', [
    '(1, 1)' => [1, 1],
]);
dataset('isIdenticalTo(failing)', [
    "(1, '1')"   => [1, '1', 'Expected a value identical to: 1 (int). Got: "1" (string)'],
    '(1, true)'  => [1, true, 'Expected a value identical to: 1 (int). Got: true (bool)'],
    '(1, false)' => [1, false, 'Expected a value identical to: 1 (int). Got: false (bool)'],
]);
