<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(new stdClass())'         => [new stdClass()],
    '(new RuntimeException())' => [new RuntimeException()],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(null)' => [null, 'Expected an object. Got: null (null)'],
    '(true)' => [true, 'Expected an object. Got: true (bool)'],
    '(1)'    => [1, 'Expected an object. Got: 1 (int)'],
    '([])'   => [[], 'Expected an object. Got: array (array)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
