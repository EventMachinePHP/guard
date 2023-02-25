<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('abcd', 'ab')" => ['abcd', 'ab'],
    "('äþçð', 'äþ')" => ['äþçð', 'äþ'],
    "('あいうえ', 'あい')" => ['あいうえ', 'あい'],
    "('😄😑☹️', '😄')"  => ['😄😑☹️', '😄'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('abcd', 'bc')" => ['abcd', 'bc', 'Expected a string starting with "bc". Got: "abcd" (string)'],
    "('', 'bc')"     => ['', 'bc', 'Expected a string starting with "bc". Got: "" (string)'],
    "('äþçð', 'þç')" => ['äþçð', 'þç', 'Expected a string starting with "þç". Got: "äþçð" (string)'],
    "('', 'þç')"     => ['', 'þç', 'Expected a string starting with "þç". Got: "" (string)'],
    "('あいうえ', 'いう')" => ['あいうえ', 'いう', 'Expected a string starting with "いう". Got: "あいうえ" (string)'],
    "('', 'いう')"     => ['', 'いう', 'Expected a string starting with "いう". Got: "" (string)'],
    "('😄😑☹️', '😑')"  => ['😄😑☹️', '😑', 'Expected a string starting with "😑". Got: "😄😑☹️" (string)'],
    "('', '😑')"      => ['', '😑', 'Expected a string starting with "😑". Got: "" (string)'],
]);
