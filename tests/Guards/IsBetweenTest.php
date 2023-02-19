<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

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
