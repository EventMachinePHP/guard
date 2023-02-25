<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

dataset(passingCasesDataset(filePath: __FILE__), [
    '(Guard::class)'   => [Guard::class],
    '(new stdClass())' => [new stdClass()],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "__NAMESPACE__.'\Foobar'" => [__NAMESPACE__.'\Foobar', 'Expected an existing class name. Got: "\Foobar" (string)'],
]);
