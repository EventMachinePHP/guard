<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This test file contains tests for the {@see Guard::isThrowing()} method.
 */
test(description: passingCasesDescription(__FILE__), closure: function ($expression, $classString): void {
    $value = $classString === null
        ? Guard::isThrowing(
            expression: $expression
        )
        : Guard::isThrowing(
            expression: $expression,
            classString: $classString,
        );

    expect($value)->toBeCallable();
})->with(data: passingCasesDataset(__FILE__));

test(description: failingCasesDescription(__FILE__), closure: function ($expression, $classString, $errorMessage): void {
    $this->expectException(InvalidGuardArgumentException::class);
    $this->expectExceptionMessage($errorMessage);

    $classString === null
        ? Guard::isThrowing(
            expression: $expression
        )
        : Guard::isThrowing(
            expression: $expression,
            classString: $classString,
        );
})->with(data: failingCasesDataset(__FILE__));

test(description: errorMessagesDescription(__FILE__), closure: function ($expression, $classString, $errorMessage): void {
    $this->expectExceptionObject(new InvalidGuardArgumentException(message: CUSTOM_ERROR_MESSAGE));

    Guard::isThrowing(
        expression: $expression,
        classString: $classString,
        message: CUSTOM_ERROR_MESSAGE,
    );
})->with(data: randomFailingCase(__FILE__));
