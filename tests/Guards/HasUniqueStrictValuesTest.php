<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::hasUniqueStrictValues(passing)')
    ->with('hasUniqueStrictValues(passing)')
    ->expect(fn ($values) => Guard::hasUniqueStrictValues(values: $values))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($values) => $values)
    ->notToThrowInvalidArgumentException();

test('Guard::hasUniqueStrictValues(failing)')
    ->expectInvalidArgumentException(fn ($values, $message) => $message)
    ->with('hasUniqueStrictValues(failing)')
    ->expect(fn ($values, $message) => Guard::hasUniqueStrictValues(values: $values));

test('Guard::hasUniqueStrictValues() Aliases')
    ->expect('hasUniqueStrictValues')
    ->validateAliases();

dataset('hasUniqueStrictValues(passing)', [
    '([1])'             => [[1]],
    '([1, 2, 3, 4])'    => [[1, 2, 3, 4]],
    "(['a', 'b', 'c'])" => [['a', 'b', 'c']],
    "([1, '1'])"        => [[1, '1']],
    '([true, 1])'       => [[true, 1]],
    '([null, false])'   => [[null, false]],
    '([])'              => [[]],
]);
dataset('hasUniqueStrictValues(failing)', [
    '([1, 2, 3, 1])'          => [[1, 2, 3, 1], 'Expected strict unique values. Got duplicate values'],
    "(['a', 'b', 'a'])"       => [['a', 'b', 'a'], 'Expected strict unique values. Got duplicate values'],
    '([[true, 1, 1]])'        => [[true, 1, 1], 'Expected strict unique values. Got duplicate values'],
    '([[null, false, null]])' => [[null, false, null], 'Expected strict unique values. Got duplicate values'],
]);
