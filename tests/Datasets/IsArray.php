<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '([])'        => [[]],
    '([1, 2, 3])' => [[1, 2, 3]],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(123)'                   => [123, 'Expected an array. Got: 123 (int)'],
    '(new stdClass())'        => [new stdClass(), 'Expected an array. Got: stdClass (stdClass)'],
    '(new ArrayIterator([]))' => [new ArrayIterator([]), 'Expected an array. Got: ArrayIterator (ArrayIterator)'],
]);
