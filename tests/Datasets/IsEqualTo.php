<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1, 1)'     => [1, 1],
    "(1, '1')"   => [1, '1'],
    '(1, true)'  => [1, true],
    '(0, false)' => [0, false],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(1, 2)'     => [1, 2, 'Expected a value equal to: 1 (int). Got: 2 (int)'],
    "(1, '2')"   => [1, '2', 'Expected a value equal to: 1 (int). Got: "2" (string)'],
    '(1, false)' => [1, false, 'Expected a value equal to: 1 (int). Got: false (bool)'],
]);
