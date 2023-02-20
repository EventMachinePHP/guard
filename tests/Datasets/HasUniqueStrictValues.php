<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '([1])'             => [[1]],
    '([1, 2, 3, 4])'    => [[1, 2, 3, 4]],
    "(['a', 'b', 'c'])" => [['a', 'b', 'c']],
    "([1, '1'])"        => [[1, '1']],
    '([true, 1])'       => [[true, 1]],
    '([null, false])'   => [[null, false]],
    '([])'              => [[]],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '([1, 2, 3, 1])'        => [[1, 2, 3, 1], 'Expected strict unique values. Got duplicate values'],
    "(['a', 'b', 'a'])"     => [['a', 'b', 'a'], 'Expected strict unique values. Got duplicate values'],
    '([true, 1, 1])'        => [[true, 1, 1], 'Expected strict unique values. Got duplicate values'],
    '([null, false, null])' => [[null, false, null], 'Expected strict unique values. Got duplicate values'],
]);
