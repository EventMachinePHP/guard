<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::that()->(...)(passing)')
    ->expect(
        Guard::that(value: 123)
            ->isNumeric()
            ->isInteger()
            ->isPositiveInteger()
            ->isGreaterThan(limit: 100)
            ->validate()
    )
    ->toBe(123)
    ->notToThrowInvalidArgumentException();

test('Guard::that()->(...)(failing)')
    ->expectException(InvalidArgumentException::class)
    ->expect(
        fn () => Guard::that(value: 123)
            ->isNumeric()
            ->isInteger()
            ->isPositiveInteger()
            ->isGreaterThan(limit: 200)
            ->validate()
    );
