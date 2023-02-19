<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    "(new Exception(), 'stdClass')" => [new Exception(), 'stdClass'],
    "(123, 'stdClass')"             => [123, 'stdClass'],
    "([], 'stdClass'')"             => [[], 'stdClass'],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "new stdClass(), 'stdClass')" => [new stdClass(), 'stdClass', 'Expected a value not being an instance of stdClass. Got: stdClass (stdClass)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
