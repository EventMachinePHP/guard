<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(tmpfile())' => [tmpfile(), null],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "(tmpfile(), 'invalid-type')" => [tmpfile(), 'invalid-type', 'Expected a resource of type: invalid-type. Got: stream'],
    '(1)'                         => [1, null, 'Expected a resource. Got: 1 (int)'],
]);
