<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value) => (
        Guard::isArray(
            value: $value
        )
    ))
    ->toBeArray()
    ->toHaveValue(fn ($value) => $value);
