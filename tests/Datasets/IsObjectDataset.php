<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(new stdClass())'         => [new stdClass()],
    '(new RuntimeException())' => [new RuntimeException()],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(null)' => [null, 'Expected an object. Got: null (null)'],
    '(true)' => [true, 'Expected an object. Got: true (bool)'],
    '(1)'    => [1, 'Expected an object. Got: 1 (int)'],
    '([])'   => [[], 'Expected an object. Got: array (array)'],
]);
