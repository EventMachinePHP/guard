<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    "(new ArrayIterator(), ['Iterator', 'ArrayAccess'])" => [new ArrayIterator(), ['Iterator', 'ArrayAccess']],
    "(new Exception(), ['Exception', 'Countable'])"      => [new Exception(), ['Exception', 'Countable']],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "(new Exception(), ['Exception', 'Countable'])" => [new Exception(), ['ArrayAccess', 'Countable'], 'Expected an instance of any of ArrayAccess, Countable. Got: Exception'],
    "(123, ['ArrayAccess', 'stdClass'])"            => [123, ['ArrayAccess', 'stdClass'], 'Expected an instance of any of ArrayAccess, stdClass. Got: 123 (int)'],
    "([], ['stdClass')"                             => [[], ['stdClass'], 'Expected an instance of any of stdClass. Got: array (array)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
