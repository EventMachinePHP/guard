<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\NullOrGuardExceptionGuard;

test('Guard::not()->isString(passing1)')
    ->expect(Guard::nullOr()->isString(value: 'string'))
    ->toBe('string');

test('Guard::not()->isString(passing2)')
    ->expect(Guard::nullOr()->isString(value: null))
    ->toBe(null);

test('Guard::nullOr()->isString(failingCases)')
    ->expectExceptionMessage('Expected null or ')
    ->throws(NullOrGuardExceptionGuard::class)
    ->expect(fn () => Guard::nullOr()->isString(value: 123));
