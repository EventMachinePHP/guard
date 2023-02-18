<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\NullOrGuardExceptionGuard;

test('Guard::not()->isString(passing1)')
    ->expect(Guard::nullOr()->isString(value: 'string'))
    ->toBe('string')
    ->notToThrowInvalidArgumentException();

test('Guard::not()->isString(passing2)')
    ->expect(Guard::nullOr()->isString(value: null))
    ->toBe(null)
    ->notToThrowInvalidArgumentException();

test('Guard::nullOr()->isString(failing)')
    ->expectExceptionMessage('Expected null or ')
    ->throws(NullOrGuardExceptionGuard::class)
    ->expect(fn () => Guard::nullOr()->isString(value: 123));
