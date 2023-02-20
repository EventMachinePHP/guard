<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(2, 1)' => [2, 1],
    '(1, 1)' => [1, 1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(0, 1)' => [0, 1, 'Expected a value greater than or equal to: 1 (int). Got: 0 (int)'],
]);