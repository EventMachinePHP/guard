<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('abc')"                        => ['abc'],
    "('hello')"                      => ['hello'],
    "('abcdefghijklmnopqrstuvwxyz')" => ['abcdefghijklmnopqrstuvwxyz'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('Abc123')"       => ['Abc123', 'Expected lowercase characters only. Got: "Abc123" (string)'],
    "('ABC')"          => ['ABC', 'Expected lowercase characters only. Got: "ABC" (string)'],
    "('')"             => ['', 'Expected lowercase characters only. Got: "" (string)'],
    '(null)'           => [null, 'Expected a string. Got: null (null)'],
    '([1, 2, 3])'      => [[1, 2, 3], 'Expected a string. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true)'           => [true, 'Expected a string. Got: true (bool)'],
    '(false)'          => [false, 'Expected a string. Got: false (bool)'],
]);
