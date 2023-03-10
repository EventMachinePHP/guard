<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(strlen)'                           => ['strlen'],
    '(fn (): Closure => function () {})' => [fn (): Closure => function (): void {}],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(1234)'  => [1234, 'Expected a callable. Got: 1234 (int)'],
    "('foo')" => ['foo', 'Expected a callable. Got: "foo" (string)'],
]);
