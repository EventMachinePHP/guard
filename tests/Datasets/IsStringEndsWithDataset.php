<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('abcd', 'cd')" => ['abcd', 'cd'],
    "('äþçð', 'çð')" => ['äþçð', 'çð'],
    "('あいうえ', 'うえ')" => ['あいうえ', 'うえ'],
    "('😄😑☹️', '☹️')" => ['😄😑☹️', '☹️'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('abcd', 'bc')" => ['abcd', 'bc', 'Expected a string ending with "bc". Got: "abcd" (string)'],
    "('', 'bc')"     => ['', 'bc', 'Expected a string ending with "bc". Got: "" (string)'],
    "('äþçð', 'þç')" => ['äþçð', 'þç', 'Expected a string ending with "þç". Got: "äþçð" (string)'],
    "('', 'þç')"     => ['', 'þç', 'Expected a string ending with "þç". Got: "" (string)'],
    "('あいうえ', 'いう')" => ['あいうえ', 'いう', 'Expected a string ending with "いう". Got: "あいうえ" (string)'],
    "('', 'いう')"     => ['', 'いう', 'Expected a string ending with "いう". Got: "" (string)'],
    "('😄😑☹️', '😑')"  => ['😄😑☹️', '😑', 'Expected a string ending with "😑". Got: "😄😑☹️" (string)'],
    "('', '😑')"      => ['', '😑', 'Expected a string ending with "😑". Got: "" (string)'],
]);
