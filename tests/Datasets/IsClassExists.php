<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

dataset(passingCasesDescription(filePath: __FILE__), [
    '(Guard::class)' => [Guard::class],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "__NAMESPACE__.'\Foobar'" => [__NAMESPACE__.'\Foobar', 'Expected an existing class name. Got: "\Foobar" (string)'],
]);
