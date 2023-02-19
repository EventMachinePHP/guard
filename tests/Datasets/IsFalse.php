<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(false)' => [false],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(true)' => [true, 'a'],
    '(1)'    => [1, 'a'],
    '(null)' => [null, 'a'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
