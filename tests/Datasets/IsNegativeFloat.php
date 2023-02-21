<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(-123.123)' => [-123.123],
    '(-1.1)'     => [-1.1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(123.123)' => [123.123, 'Expected a float value less than 0 (float). Got: 123.123 (float)'],
]);
