<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(1)' => [1],
    '(0)' => [0],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(10)' => [10, 'Expected a digit. Got: 10 (int)'],
]);
