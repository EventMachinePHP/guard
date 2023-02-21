<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('')" => ['', 'Expected a non-empty-string. Got: "" (string)'],
    '(1)'  => [1, 'Expected a non-empty-string. Got: 1 (int)'],
]);
