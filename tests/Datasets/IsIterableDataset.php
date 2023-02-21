<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '([])'                        => [[]],
    '([1, 2, 3])'                 => [[1, 2, 3]],
    '(new ArrayIterator([1,2,3])' => [new ArrayIterator([1, 2, 3])],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(123)'            => [123, 'Expected an iterable. Got: 123 (int)'],
    '(new stdClass())' => [new stdClass(), 'Expected an iterable. Got: stdClass (stdClass)'],
]);
