<?php

declare(strict_types=1);

dataset(passingCasesDataset(filePath: __FILE__), [
    "('abcd', 'ab')" => ['abcd', 'ab'],
    "('abcd', 'bc')" => ['abcd', 'bc'],
    "('abcd', 'cd')" => ['abcd', 'cd'],
    "('äþçð', 'äþ')" => ['äþçð', 'äþ'],
    "('äþçð', 'þç')" => ['äþçð', 'þç'],
    "('äþçð', 'çð')" => ['äþçð', 'çð'],
    "('あいうえ', 'あい')" => ['あいうえ', 'あい'],
    "('あいうえ', 'いう')" => ['あいうえ', 'いう'],
    "('あいうえ', 'うえ')" => ['あいうえ', 'うえ'],
    "('😄😑☹️', '😄')"  => ['😄😑☹️', '😄'],
    "('😄😑☹️', '😑')"  => ['😄😑☹️', '😑'],
    "('😄😑☹️', '☹️')" => ['😄😑☹️', '☹️'],
]);

dataset(failingCasesDataset(filePath: __FILE__), [
    "('abcd', 'de')"  => ['abcd', 'de', 'Expected a string containing "de". Got: "abcd" (string)'],
    "('', 'de')"      => ['', 'de', 'Expected a string containing "de". Got: "" (string)'],
    "('äþçð', 'ðé')"  => ['äþçð', 'ðé', 'Expected a string containing "ðé". Got: "äþçð" (string)'],
    "('', 'ðé')"      => ['', 'ðé', 'Expected a string containing "ðé". Got: "" (string)'],
    "('あいうえ', 'えお')"  => ['あいうえ', 'えお', 'Expected a string containing "えお". Got: "あいうえ" (string)'],
    "('', 'えお')"      => ['', 'えお', 'Expected a string containing "えお". Got: "" (string)'],
    "('😄😑☹️', '😄☹️')" => ['😄😑☹️', '😄☹️', 'Expected a string containing "😄☹️". Got: "😄😑☹️" (string)'],
    "('', '😑')"       => ['', '😑', 'Expected a string containing "😑". Got: "" (string)'],
]);
