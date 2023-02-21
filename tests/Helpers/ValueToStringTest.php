<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::valueToString()', function ($value, $string): void {
    expect(Guard::valueToString(value: $value))->toBe($string);
})->with([
    '(null)'                                => [null, 'null'],
    '(true)'                                => [true, 'true'],
    '(false)'                               => [false, 'false'],
    '([])'                                  => [[], 'array'],
    '(123)'                                 => [123, '123'],
    '(1.23)'                                => [1.23, '1.23'],
    "('string')"                            => ['string', '"string"'],
    '("\r")'                                => ["\r", '<CR>'],
    '("\n")'                                => ["\n", '<LF>'],
    '("\t")'                                => ["\t", '<HT>'],
    "(new DateTime('2023-02-10'))"          => [new DateTime('2023-02-10'), 'DateTime'],
    "(new DateTimeImmutable('2023-02-10'))" => [new DateTimeImmutable('2023-02-10'), 'DateTimeImmutable'],
    '(new stdClass())'                      => [new stdClass(), 'stdClass'],
    'tmpfile()'                             => [tmpfile(), 'resource'],
]);
