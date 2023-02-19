<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use EventMachinePHP\Guard\Guard;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($value, $limit) => (
        Guard::isLessThan(
            value: $value,
            limit: $limit
        )
    ))
    ->toHaveValue(fn ($value) => $value)
    ->toHaveValueThat(assertionName: 'toBeLessThan', callable: fn ($value, $limit) => $limit);
