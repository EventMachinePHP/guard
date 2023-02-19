<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

test(description: passingCasesDescription(__FILE__))
    ->with(data: passingCasesDescription(__FILE__))
    ->expect(fn ($values) => (
        Guard::hasUniqueLooseValues(
            values: $values
        )
    ))
    ->toHaveValue(fn ($values) => $values);

//test(description: failingCasesDescription(__FILE__))
//    ->with(data: failingCasesDescription(__FILE__))
//    ->with(data: errorMessagesDescription(__FILE__))
//    ->expectException(InvalidGuardArgumentException::class)
//    ->expectExceptionMessage(fn ($values, $message) => $message)
//    ->expect(fn ($values, $message) => Guard::hasUniqueLooseValues(values: $values));
