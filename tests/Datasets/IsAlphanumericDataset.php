<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('Abc123')" => ['Abc123'],
    "('12345')"  => ['12345'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('Abc$%123',)"     => ['Abc$%123', 'Expected alphanumeric characters only. Got: "Abc$%123" (string)'],
    "('',)"             => ['', 'Expected alphanumeric characters only. Got: "" (string)'],
    '(null,)'           => [null, 'Expected a string. Got: null (null)'],
    '([1, 2, 3],)'      => [[1, 2, 3], 'Expected a string. Got: array (array)'],
    '(new stdClass(),)' => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true,)'           => [true, 'Expected a string. Got: true (bool)'],
    '(false,)'          => [false, 'Expected a string. Got: false (bool)'],
]);
