<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $class) => (
        Guard::isInstanceOf(
            value: $value,
            class: $class,
        )
    ))
    ->toHaveValue(fn ($value, $class) => $value)
    ->toHaveValueThat(assertionName: 'toBeInstanceOf', callable: fn ($value, $class) => $class);
