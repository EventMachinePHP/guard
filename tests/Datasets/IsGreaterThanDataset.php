<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(1, 0)' => [1, 0],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(0, 1)' => [0, 1, 'Expected a value greater than: 1 (int). Got: 0 (int)'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
]);
