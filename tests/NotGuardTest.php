<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\NotGuardException;

test('Guard::not()->isString(passing)')
    ->expect(Guard::not()->isString(value: 123))
    ->toBe(123)
    ->notToThrowInvalidArgumentException();

test('Guard::not()->isString(failing)')
    ->throws(NotGuardException::class)
    ->expect(fn () => Guard::not()->isString(value: 'string'));
