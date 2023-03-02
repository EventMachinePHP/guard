<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '("\n\t\r")' => ["\n\t\r"],
    '("\x00")'   => ["\x00"],
    '("\x1F")'   => ["\x1F"],
    '("\x7")'    => ["\x7"],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('Abc$%')"        => ['Abc$%', 'Expected control characters only. Got: "Abc$%" (string)'],
    "('Abc123')"       => ['Abc123', 'Expected control characters only. Got: "Abc123" (string)'],
    "('')"             => ['', 'Expected control characters only. Got: "" (string)'],
    '(new stdClass())' => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true)'           => [true, 'Expected a string. Got: true (bool)'],
    '(false)'          => [false, 'Expected a string. Got: false (bool)'],
]);
