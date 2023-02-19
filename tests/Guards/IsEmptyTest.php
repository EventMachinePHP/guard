<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value) => (
        Guard::isEmpty(
            value: $value
        )
    ))
    ->toBeEmpty()
    ->toHaveValue(fn ($value) => $value);
