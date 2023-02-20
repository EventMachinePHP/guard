<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(2, 2, 10)'        => [2, 2, 10],
    '(2.3, 2.3, 10.11)' => [2.3, 2.3, 10.11],
]);

// TODO: Add error messages
dataset(failingCasesDescription(filePath: __FILE__), [
    '(5, 5, 10)'        => [5, 5, 10, 'Message'],
    '(5.5, 5.5, 10.10)' => [5.5, 5.5, 10.10, 'Message'],
]);
