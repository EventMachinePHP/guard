<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(0)' => [0],
    '(1)' => [1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(-1)'   => [-1, 'Expected an integer value greater than or equal to 0 (int). Got: -1 (int)'],
    "('1')"  => ['1', 'Expected an integer value greater than or equal to 0 (int). Got: "1" (string)'],
    '(1.0)'  => [1.0, 'Expected an integer value greater than or equal to 0 (int). Got: 1 (float)'],
    '(1.23)' => [1.23, 'Expected an integer value greater than or equal to 0 (int). Got: 1.23 (float)'],
]);
