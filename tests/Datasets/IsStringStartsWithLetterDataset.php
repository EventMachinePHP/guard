<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('abcd')" => ['abcd'],
    "('a')"    => ['a'],
    "('a1')"   => ['a1'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '[66]'    => [[66], 'Expected a string starting with a letter. Got: array (array)'],
    "'1abcd'" => ['1abcd', 'Expected a string starting with a letter. Got: "1abcd" (string)'],
    "'1'"     => ['1', 'Expected a string starting with a letter. Got: "1" (string)'],
    "''"      => ['', 'Expected a string starting with a letter. Got: "" (string)'],
    'null'    => [null, 'Expected a string starting with a letter. Got: null (null)'],
    '66'      => [66, 'Expected a string starting with a letter. Got: 66 (int)'],
]);
