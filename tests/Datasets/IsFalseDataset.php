<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(false)' => [false],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(true)' => [true, 'Expected a value to be false. Got: true (bool)'],
    '(1)'    => [1, 'Expected a value to be false. Got: 1 (int)'],
    '(null)' => [null, 'Expected a value to be false. Got: null (null)'],
]);
