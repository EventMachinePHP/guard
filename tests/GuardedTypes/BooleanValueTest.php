<?php

declare(strict_types=1);

use EventMachinePHP\Guard\GuardedTypes\BooleanValue;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

test('new BooleanValue(valid)')
    ->expect(new BooleanValue(value: true))
    ->toHaveProperty('value', true);

test('(new BooleanValue(value: true))()')
    ->expect((new BooleanValue(value: true))())
    ->toBe(true);

test('new BooleanValue(invalid)')
    ->expectException(InvalidArgumentException::class)
    ->expect(fn () => new BooleanValue(value: 'invalid'));

test('BooleanValue::make()')
    ->expect(BooleanValue::make(value: false))
    ->toBeInstanceOf(BooleanValue::class)
    ->toHaveProperty('value', false);
