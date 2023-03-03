<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "(' ')"      => [' '],
    '("\n\t\r")' => ["\n\t\r"],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('Abc123')"        => ['Abc123', 'Expected whitespace characters only. Got: "Abc123" (string)'],
    "('Hello, world!')" => ['Hello, world!', 'Expected whitespace characters only. Got: "Hello, world!" (string)'],
    '((""))'            => ['', 'Expected whitespace characters only. Got: "" (string)'],
    '(null)'            => [null, 'Expected a string. Got: null (null)'],
    '([1, 2, 3])'       => [[1, 2, 3], 'Expected a string. Got: array (array)'],
    '(new stdClass())'  => [new stdClass(), 'Expected a string. Got: stdClass (stdClass)'],
    '(true)'            => [true, 'Expected a string. Got: true (bool)'],
    '(false)'           => [false, 'Expected a string. Got: false (bool)'],
]);
