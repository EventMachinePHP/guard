<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(true)' => [true],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(false)' => [false, 'Expected a value to be true. Got: false (bool)'],
    '(1)'     => [1, 'Expected a value to be true. Got: 1 (int)'],
    '(null)'  => [null, 'Expected a value to be true. Got: null (null)'],
]);
