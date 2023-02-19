<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(123)' => [123.123],
    '(1)'   => [1.1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(-123)' => [-123.123, 'Expected a value greater than: 0 (int). Got: -123.123 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
