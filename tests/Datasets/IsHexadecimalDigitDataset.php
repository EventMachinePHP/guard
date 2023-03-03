<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('0123456789abcdefABCDEF')"   => ['0123456789abcdefABCDEF'],
    "('a1b2c3d4e5f6A1B2C3D4E5F6')" => ['a1b2c3d4e5f6A1B2C3D4E5F6'],
    "('FFF')"                      => ['FFF'],
    "('0123456789')"               => ['0123456789'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('abcdefg')"      => ['abcdefg', 'Expected hexadecimal digits only. Got: "abcdefg" (string)'],
    "('')"             => ['', 'Expected hexadecimal digits only. Got: "" (string)'],
    '(null)'           => [null, 'Expected a string. Got: null (null)'],
    '([1, 2, 3])'      => [[1, 2, 3], 'Expected a string. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true)'           => [true, 'Expected a string. Got: true (bool)'],
    '(false)'          => [false, 'Expected a string. Got: false (bool)'],
]);
