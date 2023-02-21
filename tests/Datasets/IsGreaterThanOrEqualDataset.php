<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);
