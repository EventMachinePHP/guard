<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $min, $max) => (
        Guard::isBetween(
            value: $value,
            min: $min,
            max: $max
        )
    ))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $min, $max) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThan', callable: fn ($value, $min, $max) => $min)
    ->toHaveValueThat(assertionName: 'toBeLessThan', callable: fn ($value, $min, $max) => $max);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $message) => $message)
    ->expect(fn ($value, $min, $max, $message) => (
        Guard::isBetween(
            value: $value,
            min: $min,
            max: $max
        )
    ));

test(description: errorMessagesDescription(__FILE__))
    ->with(data: randomFailingCase(__FILE__))
    ->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE))
    ->expectException(InvalidGuardArgumentException::class)
    ->expect(fn ($value, $min, $max, $message) => (
        Guard::isBetween(
            value: $value,
            min: $min,
            max: $max,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
