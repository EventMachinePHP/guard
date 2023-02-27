<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    ['abcdefg1234567'],
    ['1234567abcdefg'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    ['1234 567', 'Expected alphanumeric characters only. Got: "1234 567" (string)'],
    ['abc$def', 'Expected alphanumeric characters only. Got: "abc$def" (string)'],
]);
