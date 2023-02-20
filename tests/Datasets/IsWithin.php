<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(2, 2, 10)'        => [2, 2, 10],
    '(2.3, 2.3, 10.11)' => [2.3, 2.3, 10.11],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(4, 5, 10)'        => [4, 5, 10, 'Expected a value within the bounds of 5 (int) and 10 (int). Got: 4 (int)'],
    '(4.5, 5.5, 10.10)' => [4.5, 5.5, 10.10, 'Expected a value within the bounds of 5.5 (float) and 10.1 (float). Got: 4.5 (float)'],
]);
