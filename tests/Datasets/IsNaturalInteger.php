<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(0)' => [0],
    '(1)' => [1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(-1)'   => [-1, 'Expected a value greater than or equal to: 0 (int). Got: -1 (int)'],
    "('1')"  => ['1', 'Expected an integer. Got: string'],
    '(1.0)'  => [1.0, 'Expected an integer. Got: float'],
    '(1.23)' => [1.23, 'Expected an integer. Got: float'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
