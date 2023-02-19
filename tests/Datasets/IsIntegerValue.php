<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(123)'   => [123],
    '(1.0)'   => [1.0],
    "('123')" => ['123'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(12.34)'  => [12.34, 'Expected an isIntegerValue value. Got: 12.34 (float)'],
    '(true)'   => [true, 'Expected an isIntegerValue value. Got: true (bool)'],
    '(null)'   => [null, 'Expected an isIntegerValue value. Got: null (null)'],
    '(array)'  => [[], 'Expected an isIntegerValue value. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected an isIntegerValue value. Got: stdClass (stdClass)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
