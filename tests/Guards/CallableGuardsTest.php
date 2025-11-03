<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\ExceptionMessage;
use EventMachinePHP\Guard\Tests\GuardTestCase;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This block contains tests for the {@see Guard::isCallable()} method.
 */
describe(description: 'isCallable()', tests: function(): void {
    $passingCases =  [
        GuardTestCase::O001_OBJECT_CLOSURE,
        GuardTestCase::O002_OBJECT_CLOSURE_RETURNS_CLOSURE,
        GuardTestCase::O008_OBJECT_ANONYMOUS_INVOKABLE_CLASS,
    ];

    test(description: 'pass', closure: function (mixed $value): void {
        $result = Guard::isCallable(value: $value);

        expect($result)
            ->toBeCallable()
            ->toBe($value);
    })->with([
        ...testCases($passingCases),
        ...[
            '(strlen)'     => 'strlen',
            '(strtoupper)' => 'strtoupper',
        ],
    ]);

    test(description: 'fail', closure: function (mixed $value): void {
        expect(fn () => Guard::isCallable(value: $value))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: ExceptionMessage::IsCallable->value
            );
    })->with(allCases(except: $passingCases));

    test(description: 'msg', closure: function (mixed $value): void {
        expect(fn () => Guard::isCallable(value: $value, message: CUSTOM_ERROR_MESSAGE))
            ->toThrow(
                exception: InvalidGuardArgumentException::class,
                exceptionMessage: CUSTOM_ERROR_MESSAGE
            );
    })->with(randomCase(except: $passingCases));
});
