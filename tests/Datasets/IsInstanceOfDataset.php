<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "(new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass', 'Expected an instance of stdClass. Got: Exception'],
    '(123)'                         => [123, 'stdClass', 'Expected an instance of stdClass. Got: 123 (int)'],
    '([])'                          => [[], 'stdClass', 'Expected an instance of stdClass. Got: array (array)'],
    '(null)'                        => [null, 'stdClass', 'Expected an instance of stdClass. Got: null (null)'],
]);
