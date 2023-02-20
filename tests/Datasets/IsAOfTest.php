<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    "('stdClass', 'stdClass')"           => ['stdClass', 'stdClass'],
    '(stdClass::class, stdClass::class)' => [stdClass::class, stdClass::class],
    "('ValueError', 'Error')"            => ['ValueError', 'Error'],
    '(ValueError::class, Error::class)'  => [ValueError::class, Error::class],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    "('stdClass', 123)"                          => ['stdClass', 123, 'Expected an instance of this class or to this class among its parents "123". Got: "stdClass" (string)'],
    '(stdClass::class, 123)'                     => [stdClass::class, 123, 'Expected an instance of this class or to this class among its parents "123". Got: "stdClass" (string)'],
    '(RuntimeException::class, stdClass::class)' => [RuntimeException::class, stdClass::class, 'Expected an instance of this class or to this class among its parents "stdClass". Got: "RuntimeException" (string)'],
    "('RuntimeException', 'stdClass')"           => ['RuntimeException', 'stdClass', 'Expected an instance of this class or to this class among its parents "stdClass". Got: "RuntimeException" (string)'],
    "('NonExistentClass', stdClass::class)"      => ['NonExistentClass', stdClass::class, 'Expected an instance of this class or to this class among its parents "stdClass". Got: "NonExistentClass" (string)'],
    "('string', 'stdClass')"                     => ['string', 'stdClass', 'Expected an instance of this class or to this class among its parents "stdClass". Got: "string" (string)'],
    "('Iterator', 'ArrayIterator')"              => ['Iterator', 'ArrayIterator', 'Expected an instance of this class or to this class among its parents "ArrayIterator". Got: "Iterator" (string)'],
    '(Iterator::class, ArrayIterator::class)'    => [Iterator::class, ArrayIterator::class, 'Expected an instance of this class or to this class among its parents "ArrayIterator". Got: "Iterator" (string)'],
    "(123, 'Iterator')"                          => [123, 'Iterator', 'Expected an instance of this class or to this class among its parents "Iterator". Got: 123 (int)'],
    '(123, Iterator::class)'                     => [123, Iterator::class, 'Expected an instance of this class or to this class among its parents "Iterator". Got: 123 (int)'],
    "([], 'Iterator')"                           => [[], 'Iterator', 'Expected an instance of this class or to this class among its parents "Iterator". Got: array (array)'],
    '([], Iterator::class)'                      => [[], Iterator::class, 'Expected an instance of this class or to this class among its parents "Iterator". Got: array (array)'],
]);
