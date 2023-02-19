<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $type) => (
        Guard::isResource(
            value: $value,
            type: $type
        )
    ))
    ->toBeResource()
    ->toHaveValue(fn ($value, $type) => $value);
