<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    "('value')" => ['value'],
    "('0')"     => ['0'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "('')" => ['', 'Expected a value different from: "" (string). Got: "" (string)'],
    '(1)'  => [1, 'Expected a string. Got: 1 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
