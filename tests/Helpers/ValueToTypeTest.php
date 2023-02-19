<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::valueToType', function ($value, $string): void {
    expect(Guard::valueToType(value: $value))->toBe($string);
})->with([
    '(null)'                       => [null, 'null'],
    '(true)'                       => [true, 'bool'],
    '(false)'                      => [false, 'bool'],
    '([])'                         => [[], 'array'],
    '(123)'                        => [123, 'int'],
    '(1.23)'                       => [1.23, 'float'],
    "('string')"                   => ['string', 'string'],
    '(new DateTime())'             => [new DateTime(), 'DateTime'],
    '(new DateTimeImmutable())'    => [new DateTimeImmutable(), 'DateTimeImmutable'],
    '(new stdClass())'             => [new stdClass(), 'stdClass'],
    "(fopen('php://memory', 'r'))" => [fopen('php://memory', 'r'), 'resource (stream)'],
]);
