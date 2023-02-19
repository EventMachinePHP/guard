<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    "('abc')"  => ['abc'],
    "('23')"   => ['23'],
    "('23.5')" => ['23.5'],
    "('')"     => [''],
    "(' ')"    => [' '],
    "('0')"    => ['0'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(true)'   => [true, 'Expected a string. Got: true (bool)'],
    '(false)'  => [false, 'Expected a string. Got: false (bool)'],
    '(null)'   => [null, 'Expected a string. Got: null (null)'],
    '(0)'      => [0, 'Expected a string. Got: 0 (int)'],
    '(23)'     => [23, 'Expected a string. Got: 23 (int)'],
    '(23.5)'   => [23.5, 'Expected a string. Got: 23.5 (float)'],
    '(array)'  => [[], 'Expected a string. Got: array (array)'],
    '(object)' => [new stdClass(), 'Expected a string. Got: stdClass'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
