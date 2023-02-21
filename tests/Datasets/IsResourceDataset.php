<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(fopen(...))'           => [fopen('php://memory', 'r'), null],
    "(fopen(...), 'stream')" => [fopen('php://memory', 'r'), 'stream'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "(fopen(...), 'other')" => [fopen('php://memory', 'r'), 'other', 'Expected a resource of type: other. Got: stream'],
    '(1)'                   => [1, null, 'Expected a resource. Got: 1 (int)'],
]);
