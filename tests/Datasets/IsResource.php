<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(fopen(,,))'           => [fopen('php://memory', 'r'), null],
    "(fopen(,,), 'stream')" => [fopen('php://memory', 'r'), 'stream'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "(fopen(,,), 'other')" => [fopen('php://memory', 'r'), 'other', 'Expected a resource of type: other. Got: stream'],
    '(1)'                  => [1, null, 'Expected a resource. Got: 1 (int)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
