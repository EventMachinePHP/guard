<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '([])'                  => [[]],
    '([1, 2, 3])'           => [[1, 2, 3]],
    '(new ArrayObject([]))' => [new ArrayObject([])],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(123)'            => [123, 'Expected an array or an object implementing ArrayAccess. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an array or an object implementing ArrayAccess. Got: stdClass (stdClass)'],
]);
