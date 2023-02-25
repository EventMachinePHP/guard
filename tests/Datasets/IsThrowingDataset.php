<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    '(LogicException)' => [fn () => function (): void { throw new LogicException('test'); }, 'LogicException'],
    '(Exception)'      => [fn () => function (): void { throw new Exception('test'); }, null],
    '(trigger_error)'  => [fn () => function (): void { trigger_error('test'); }, 'Throwable'],
    '(Error)'          => [fn () => function (): void { throw new Error(); }, 'Throwable'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    '(IllogicException, IllogicException)' => [fn () => function (): void { throw new LogicException('test'); }, 'IllogicException', 'Expected to throw "IllogicException", got "LogicException"'],
    '(trigger_error, Unthrowable)'         => [fn () => function (): void { trigger_error('test'); }, 'Unthrowable', 'Expected to throw "Unthrowable", got "Whoops\Exception\ErrorException"'],
    '(trigger_error, 123)'                 => [fn () => function (): void { trigger_error('test'); }, 123, 'Expected a string. Got: 123 (int)'],
]);
