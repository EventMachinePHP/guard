<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(123)'   => [123],
    '(1.0)'   => [1.0],
    "('123')" => ['123'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(12.34)'          => [12.34, 'Expected an isIntegerValue value. Got: 12.34 (float)'],
    '(true)'           => [true, 'Expected an isIntegerValue value. Got: true (bool)'],
    '(null)'           => [null, 'Expected an isIntegerValue value. Got: null (null)'],
    '([])'             => [[], 'Expected an isIntegerValue value. Got: array (array)'],
    '(new stdClass())' => [new stdClass(), 'Expected an isIntegerValue value. Got: stdClass (stdClass)'],
]);
