<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1.0)'  => [1.0],
    '(1.23)' => [1.23],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(123)'   => [123, 'Expected a float. Got: 123 (int)'],
    "('123')" => ['123', 'Expected a float. Got: "123" (string)'],
]);
