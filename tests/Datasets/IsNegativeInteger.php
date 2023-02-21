<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(-123)' => [-123],
    '(-1)'   => [-1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(123)'    => [123, 'Expected an integer value greater than 0 (int). Got: 123 (int)'],
    '(0)'      => [0, 'Expected an integer value greater than 0 (int). Got: 0 (int)'],
    '(0.0)'    => [0.0, 'Expected an integer value greater than 0 (int). Got: 0 (float)'],
    "('-123')" => ['-123', 'Expected an integer value greater than 0 (int). Got: "-123" (string)'],
    "('123')"  => ['123', 'Expected an integer value greater than 0 (int). Got: "123" (string)'],
    "('0')"    => ['0', 'Expected an integer value greater than 0 (int). Got: "0" (string)'],
    '(1.0)'    => [1.0, 'Expected an integer value greater than 0 (int). Got: 1 (float)'],
    '(1.23)'   => [1.23, 'Expected an integer value greater than 0 (int). Got: 1.23 (float)'],
    '(-1.0)'   => [-1.0, 'Expected an integer value greater than 0 (int). Got: -1 (float)'],
    '(-1.23)'  => [-1.23, 'Expected an integer value greater than 0 (int). Got: -1.23 (float)'],
]);
