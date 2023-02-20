<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1.0)'   => [1.0],
    '(1.23)'  => [1.23],
    '(123)'   => [123],
    "('123')" => ['123'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "('foo')" => ['foo', 'Expected a numeric value. Got: "foo" (string)'],
]);
