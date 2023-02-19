<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::that()->(...)(passingCases)')
    ->expect(
        Guard::that(value: 123)
            ->isNumeric()
            ->isInteger()
            ->isPositiveInteger()
            ->isGreaterThan(limit: 100)
            ->validate()
    )
    ->toBe(123);

test('Guard::that()->(...)(failingCases)')
    ->expectException(InvalidArgumentException::class)
    ->expect(
        fn () => Guard::that(value: 123)
            ->isNumeric()
            ->isInteger()
            ->isPositiveInteger()
            ->isGreaterThan(limit: 200)
            ->validate()
    );
