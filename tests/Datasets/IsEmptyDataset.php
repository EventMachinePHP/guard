<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(null)'  => [null],
    '(false)' => [false],
    "('0')"   => ['0'],
    '(0)'     => [0],
    '(0.0)'   => [0.0],
    "('')"    => [''],
    '([])'    => [[]],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(1)'              => [1, 'Expected an empty value. Got: 1 (int)'],
    "('a')"            => ['a', 'Expected an empty value. Got: "a" (string)'],
    "('0 Text')"       => ['0 Text', 'Expected an empty value. Got: "0 Text" (string)'],
    "('00')"           => ['00', 'Expected an empty value. Got: "00" (string)'],
    "('0 0')"          => ['0 0', 'Expected an empty value. Got: "0 0" (string)'],
    '(new stdClass())' => [new stdClass(), 'Expected an empty value. Got: stdClass (stdClass)'],
]);
