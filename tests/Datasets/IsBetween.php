<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(5, 2, 10)'        => [5, 2, 10],
    '(5.6, 2.3, 10.11)' => [5.6, 2.3, 10.11],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(5, 5, 10)'        => [5, 5, 10, 'Expected a value between 5 (int) and 10 (int). Got: 5 (int)'],
    '(5.5, 5.5, 10.10)' => [5.5, 5.5, 10.10, 'Expected a value between 5.5 (float) and 10.1 (float). Got: 5.5 (float)'],
]);
