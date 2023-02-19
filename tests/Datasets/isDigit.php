<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1)' => [1],
    '(0)' => [0],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(10)' => [10, 'Expected a value greater than: 0 (int). Got: -123.123 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
