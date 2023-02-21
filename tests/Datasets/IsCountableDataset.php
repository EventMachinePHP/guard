<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '([])'                   => [[]],
    '([1, 2])'               => [[1, 2]],
    '(new ArrayIterator())'  => [new ArrayIterator()],
    '(new ArrayIterator([])' => [new ArrayIterator([])],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(new stdClass())' => [new stdClass(), 'Expected a countable value. Got: stdClass (stdClass)'],
    "('abcd')"         => ['abcd', 'Expected a countable value. Got: "abcd" (string)'],
    '(123)'            => [123, 'Expected a countable value. Got: 123 (int)'],
]);
