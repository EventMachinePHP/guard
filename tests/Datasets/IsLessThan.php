<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(0, 1)' => [0, 1],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(1, 1)' => [1, 1, 'Expected a value less than: 1 (int). Got: 1 (int)'],
]);
