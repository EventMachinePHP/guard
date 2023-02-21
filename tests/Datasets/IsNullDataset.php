<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(null)' => [null],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(false)' => [false, 'Expected null. Got: false (bool)'],
    '(0)'     => [0, 'Expected null. Got: 0 (int)'],
    '(0.0)'   => [0.0, 'Expected null. Got: 0 (float)'],
    "('')"    => ['', 'Expected null. Got: "" (string)'],
    '([])'    => [[], 'Expected null. Got: array (array)'],
]);
