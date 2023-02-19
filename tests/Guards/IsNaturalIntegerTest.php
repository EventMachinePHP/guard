<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value) => (
        Guard::isNaturalInteger(
            value: $value
        )
    ))
    ->toBeInt()
    ->toBeGreaterThanOrEqual(0)
    ->toHaveValue(fn ($value) => $value);
