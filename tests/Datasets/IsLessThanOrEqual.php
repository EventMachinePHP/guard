<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(0, 1)' => [0, 1],
    '(1, 1)' => [1, 1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(2, 1)' => [2, 1, 'Expected a value less than or equal to: 1 (int). Got: 2 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
