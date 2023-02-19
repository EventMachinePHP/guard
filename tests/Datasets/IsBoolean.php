<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(true)'  => [true],
    '(false)' => [false],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(1)'   => [1, 'Expected a boolean value. Got: 1 (int)'],
    "('1')" => ['1', 'Expected a boolean value. Got: "1" (string)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
