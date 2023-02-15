<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::hasUniqueLooseValues(passing)')
    ->with('hasUniqueLooseValues(passing)')
    ->expect(fn ($values) => Guard::hasUniqueLooseValues(values: $values))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($values) => $values)
    ->notToThrowInvalidArgumentException();

test('Guard::hasUniqueLooseValues(failing)')
    ->expectInvalidArgumentException(fn ($values, $message) => $message)
    ->with('hasUniqueLooseValues(failing)')
    ->expect(fn ($values, $message) => Guard::hasUniqueLooseValues(values: $values));

test('Guard::hasUniqueLooseValues() Aliases')
    ->expect('hasUniqueLooseValues')
    ->validateAliases();

dataset('hasUniqueLooseValues(passing)', [
    '([1, 2, 3, 4])'    => [[1, 2, 3, 4]],
    "(['a', 'b', 'c'])" => [['a', 'b', 'c']],
    '([])'              => [[]],
]);
dataset('hasUniqueLooseValues(failing)', [
    "([1, '1'])"              => [[1, '1'], 'Expected loose unique values. Got duplicate values'],
    '([true, 1])'             => [[true, 1], 'Expected loose unique values. Got duplicate values'],
    '([null, false])'         => [[null, false], 'Expected loose unique values. Got duplicate values'],
    '([1, 2, 3, 1])'          => [[1, 2, 3, 1], 'Expected loose unique values. Got duplicate values'],
    "(['a', 'b', 'a'])"       => [['a', 'b', 'a'], 'Expected loose unique values. Got duplicate values'],
    '([[true, 1, 1]])'        => [[true, 1, 1], 'Expected loose unique values. Got duplicate values'],
    '([[null, false, null]])' => [[null, false, null], 'Expected loose unique values. Got duplicate values'],
]);
