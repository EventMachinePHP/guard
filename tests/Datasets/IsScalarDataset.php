<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('1')"  => ['1'],
    '(123)'  => [123],
    '(true)' => [true],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(null)'           => [null, 'Expected a scalar value. Got: null (null)'],
    '([])'             => [[], 'Expected a scalar value. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected a scalar value. Got: stdClass (stdClass)'],
]);
