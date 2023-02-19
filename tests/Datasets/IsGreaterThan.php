<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1, 0)' => [1, 0],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(0, 1)' => [0, 1, 'Expected a value greater than: 1 (int). Got: 0 (int)'],
    '(0, 0)' => [0, 0, 'Expected a value greater than: 0 (int). Got: 0 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
