<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('1234567890')" => ['1234567890'],
    "('0')"          => ['0'],
    "('9')"          => ['9'],
    "('000')"        => ['000'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('1234abcd')"     => ['1234abcd', 'Expected digits only. Got: "1234abcd" (string)'],
    "('Abc123')"       => ['Abc123', 'Expected digits only. Got: "Abc123" (string)'],
    "('')"             => ['', 'Expected digits only. Got: "" (string)'],
    '(null)'           => [null, 'Expected a string. Got: null (null)'],
    '([1, 2, 3])'      => [[1, 2, 3], 'Expected a string. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true)'           => [true, 'Expected a string. Got: true (bool)'],
    '(false)'          => [false, 'Expected a string. Got: false (bool)'],
]);
