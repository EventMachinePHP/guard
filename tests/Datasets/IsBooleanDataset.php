<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(true)'  => [true],
    '(false)' => [false],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(1)'   => [1, 'Expected a boolean value. Got: 1 (int)'],
    "('1')" => ['1', 'Expected a boolean value. Got: "1" (string)'],
]);
