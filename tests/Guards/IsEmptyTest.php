<?php

declare(strict_types=1);

use EventMachinePHP\Guard\Guard;

test('Guard::isEmpty(passing)')
    ->with('isEmpty(passing)')
    ->expect(fn ($value) => Guard::isEmpty(value: $value))
    ->toHaveValueThat(assertionName: 'toBe', callable: fn ($value) => $value)
    ->toBeEmpty()
    ->notToThrowInvalidArgumentException();

test('Guard::isEmpty(failing)')
    ->expectInvalidArgumentException(fn ($value, $message) => $message)
    ->with('isEmpty(failing)')
    ->expect(fn ($value, $message) => Guard::isEmpty(value: $value));

//test('Guard::isEmpty() Aliases')
//    ->expect('isEmpty')
//    ->validateAliases();

dataset('isEmpty(passing)', [
    '(null)'  => [null],
    '(false)' => [false],
    "('0')"   => ['0'],
    '(0)'     => [0],
    '(0.0)'   => [0.0],
    "('')"    => [''],
    '("")'    => [''],
    '([])'    => [[]],
]);
dataset('isEmpty(failing)', [
    '(1)'              => [1, 'Expected an empty value. Got: 1 (int)'],
    "('a')"            => ['a', 'Expected an empty value. Got: "a" (string)'],
    "('0 Text')"       => ['0 Text', 'Expected an empty value. Got: "0 Text" (string)'],
    "('00')"           => ['00', 'Expected an empty value. Got: "00" (string)'],
    "('0 0')"          => ['0 0', 'Expected an empty value. Got: "0 0" (string)'],
    '(new stdClass())' => [new stdClass(), 'Expected an empty value. Got: stdClass (stdClass)'],
    '(new stdClass())' => [new stdClass(), 'Expected an empty value. Got: stdClass (stdClass)'],
]);
