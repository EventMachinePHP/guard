<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(123)' => [123],
    '(1)'   => [1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(-123)'   => [-123, 'Expected a value greater than: 0 (int). Got: -123 (int)'],
    '(0)'      => [0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
    '(0.0)'    => [0.0, 'Expected an integer. Got: float'],
    "('123')"  => ['123', 'Expected an integer. Got: string'],
    "('-123')" => ['-123', 'Expected an integer. Got: string'],
    "('0')"    => ['0', 'Expected an integer. Got: string'],
    '(1.0)'    => [1.0, 'Expected an integer. Got: float'],
    '(1.23)'   => [1.23, 'Expected an integer. Got: float'],
]);
