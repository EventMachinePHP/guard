<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(null)' => [null],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(false)' => [false, 'Expected null. Got: false (bool)'],
    '(0)'     => [0, 'Expected null. Got: 0 (int)'],
    '(0.0)'   => [0.0, 'Expected null. Got: 0 (float)'],
    "('')"    => ['', 'Expected null. Got: "" (string)'],
    '([])'    => [[], 'Expected null. Got: array (array)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
