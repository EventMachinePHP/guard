<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(1)' => [1],
    '(0)' => [0],
]);

// TODO: Add error message
dataset(failingCasesDescription(filePath: __FILE__), [
    '(10)' => [10, 'Message'],
]);
