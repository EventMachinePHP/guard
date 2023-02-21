<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isWithin()} method.
 */
test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $min, $max) => (
        Guard::isWithin(
            value: $value,
            min: $min,
            max: $max
        )
    ))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value, $min, $max) => $value)
    ->toHaveValueThat(assertionName: 'toBeGreaterThanOrEqual', callable: fn ($value, $min, $max) => $min)
    ->toHaveValueThat(assertionName: 'toBeLessThanOrEqual', callable: fn ($value, $min, $max) => $max);

test(description: failingCasesDescription(__FILE__))
    ->with(data: failingCasesDescription(__FILE__))
    ->expectException(InvalidGuardArgumentException::class)
    ->expectExceptionMessage(fn ($value, $min, $max, $message) => $message)
    ->expect(fn ($value, $min, $max, $message) => (
        Guard::isWithin(
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
        Guard::isWithin(
            value: $value,
            min: $min,
            max: $max,
            message: CUSTOM_ERROR_MESSAGE
        )
    ));
