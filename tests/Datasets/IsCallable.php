<?php

declare(strict_types=1);

dataset(passingCasesDescription(filePath: __FILE__), [
    '(strlen)'                                 => ['strlen'],
    '(fn (): Closure => function (): void {})' => [fn (): Closure => function (): void {}],
]);

dataset(failingCasesDescription(filePath: __FILE__), [
    '(1234)'  => [1234, 'Expected a callable. Got: 1234 (int)'],
    "('foo')" => ['foo', 'Expected a callable. Got: "foo" (string)'],
]);

dataset(errorMessagesDescription(filePath: __FILE__), [
    'default error message' => [null, 'DEFAULT'],
    'custom error message'  => ['Custom Error Message', 'Custom Error Message'],
]);
