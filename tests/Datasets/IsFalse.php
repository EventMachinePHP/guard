<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(false)' => [false],
]);

// TODO: Add error messages
dataset(failingCasesDescription(filePath: __FILE__), [
    '(true)' => [true, 'M'],
    '(1)'    => [1, 'M'],
    '(null)' => [null, 'M'],
]);
