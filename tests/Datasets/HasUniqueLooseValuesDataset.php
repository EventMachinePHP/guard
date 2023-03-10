<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '([1, 2, 3, 4])'    => [[1, 2, 3, 4]],
    "(['a', 'b', 'c'])" => [['a', 'b', 'c']],
    '([])'              => [[]],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "([1, '1')"            => [[1, '1'], 'Expected loose unique values. Got duplicate values'],
    '([true, 1)'           => [[true, 1], 'Expected loose unique values. Got duplicate values'],
    '([null, false)'       => [[null, false], 'Expected loose unique values. Got duplicate values'],
    '([1, 2, 3, 1)'        => [[1, 2, 3, 1], 'Expected loose unique values. Got duplicate values'],
    "(['a', 'b', 'a')"     => [['a', 'b', 'a'], 'Expected loose unique values. Got duplicate values'],
    '([true, 1, 1)'        => [[true, 1, 1], 'Expected loose unique values. Got duplicate values'],
    '([null, false, null)' => [[null, false, null], 'Expected loose unique values. Got duplicate values'],
]);
