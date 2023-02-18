<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test('Guard::all()->isString(passing)')
    ->expect(Guard::all()->isString(value: ['a', 'b', 'c']))
    ->toBe(['a', 'b', 'c'])
    ->notToThrowInvalidArgumentException();

test('Guard::all()->isGreaterThan(passing)')
    ->expect(Guard::all()->isGreaterThan(value: [10, 20.20, 30.33], limit: 5))
    ->toBe([10, 20.20, 30.33])
    ->notToThrowInvalidArgumentException();

test('Guard::all()->isString(failing)')
    ->throws(InvalidGuardArgumentException::class)
    ->expect(fn () => Guard::all()->isString(value: ['a', 'b', 1]));
