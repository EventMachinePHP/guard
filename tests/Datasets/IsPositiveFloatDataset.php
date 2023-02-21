<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(123.123)' => [123.123],
    '(1.1)'     => [1.1],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(-123.123)' => [-123.123, 'Expected a float value greater than 0 (float). Got: -123.123 (float)'],
]);
