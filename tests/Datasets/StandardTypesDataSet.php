<?php

declare(strict_types=1);

dataset('standard_type_variations', [
    // Nulls
    'null value'  => [null],
    '-null value' => [-null],
    // Booleans
    'true value as boolean'   => [true],
    '-true value as boolean'  => [-true],
    'false value as boolean'  => [false],
    '-false value as boolean' => [-false],
    // Integers
    'very big negative integer value' => [-9999999999999999999999999999999999999],
    'very big positive integer value' => [9999999999999999999999999999999999999],
    '1337 as positive integer value'  => [1337],
    '1 as positive integer value'     => [1],
    '2 as positive integer value'     => [2],
    '0 as integer value'              => [0],
    '-0 as integer value'             => [-0],
    '-1337 as negative integer value' => [-1337],
    // Floats
    '-1337.43057 as negative float value' => [1337.43057],
    '1.0 as positive float value'         => [1.0],
    '0.0 as float value'                  => [0.0],
    '-0.0 as float value'                 => [-0.0],
    '-1337.43057 as negative float value' => [-1337.43057],
    // Strings
    'null as string value'                               => ['null'],
    'true as string value'                               => ['true'],
    'false as string value'                              => ['false'],
    '1337 as string value'                               => ['1337'],
    '0001337 as string value'                            => ['0001337'],
    '1 as string value'                                  => ['1'],
    '0 as string value'                                  => ['0'],
    '-0 as string value'                                 => ['-0'],
    '2 as string value'                                  => ['2'],
    '-1337 as string value'                              => ['-1337'],
    '-0001337 as string value'                           => ['-0001337'],
    '1337.43057 as string value'                         => ['1337.43057'],
    '1.0 as string value'                                => ['1.0'],
    '0.0 as string value'                                => ['0.0'],
    '-0.0 as string value'                               => ['-0.0'],
    '-1337.43057 as string value'                        => ['-1337.43057'],
    '1,0 as string value'                                => ['1,0'],
    '1/0 as string value'                                => ['1/0'],
    '1 0 as string value'                                => ['1 0'],
    'empty string'                                       => [''],
    'string contains 1 space'                            => [' '],
    'string contains 2 space'                            => ['  '],
    'string contains 3 space'                            => ['   '],
    'string value'                                       => ['Leet'],
    'uppercase string value'                             => ['LEET'],
    'lowercase string value'                             => ['leet'],
    'string value contains numbers'                      => ['B1ff'],
    'string value contains special characters'           => ['B1!!f0'],
    'string value around spaces'                         => [' l33t '],
    'string value with newline characters'               => ["Hello\nworld!"],
    'string with basic UTF-8 characters'                 => ['Hello, 世界!'],
    'string with extended UTF-8 characters'              => ['The quick brôwn fôx jumped over the lazy dôg.'],
    'string with emojis'                                 => ['😀😂🤣😊😍'],
    'string with accented characters'                    => ['áéíóúñ'],
    'string with HTML entities'                          => ['&lt;b&gt;Bold&lt;/b&gt;'],
    'string value with leading/trailing spaces and tabs' => ["  \tleet\t\n"],
    'empty string with control characters'               => ["\n\t\r"],
    'empty string with null byte'                        => ["\0"],
    'long string value'                                  => ['A String longer than 300 characters. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies lacinia, nisl nunc aliquet massa, nec lacin, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies lacinia, nisl nunc aliquet massa, nec lacin'],
    '[] as string value'                                 => ['[]'],
    '[1, 2, 3] as string value'                          => ['[1, 2, 3]'],
    'valid json as string value'                         => ['{"name1": "Alice", "name2": "Bob"}'],
    'invalid json as string value'                       => ['{"name": "Alice", "name": "Bob"}'],
    // Arrays
    'empty array'                                        => [[]],
    'empty indexed array'                                => [[0 => []]],
    'empty negative indexed array'                       => [[-0 => []]],
    'empty float indexed array'                          => [[0.0 => []]],
    'empty negative float indexed array'                 => [[-0.0 => []]],
    'empty associative null array with empty key'        => [['' => null]],
    'empty associative array with empty key'             => [['' => []]],
    'empty associative array with null key'              => [[null => []]],
    'empty associative array with false key'             => [[false => []]],
    'empty associative array with true key'              => [[true => []]],
    'empty associative array'                            => [['empty' => []]],
    'indexed array with null value'                      => [[null]],
    'associative array with null value'                  => [['null' => [null]]],
    'indexed array with false value'                     => [[false]],
    'associative array with false value'                 => [['false' => [false]]],
    'indexed array with false and true values'           => [[false, true]],
    'indexed array with false and true values'           => ['false, true' => [false, true]],
    'indexed array with null, false and true values'     => [[null, false, true]],
    'associative array with null, false and true values' => [['null, false, true' => null, false, true]],
    'associative array with 0 as integer'                => [['0' => [0]]],
    'indexed array with 0 as integer'                    => [[0]],
    'indexed array with -0 as integer'                   => [[-0]],
    'indexed array with 0.0 as float'                    => [[0.0]],
    'indexed array with -0.0 as float'                   => [[-0.0]],
    'indexed array with 3 positive integers'             => [[1, 2, 3]],
    'indexed array with 3 negative integers'             => [[-1, -2, -3]],
    'indexed array with 3 negative floats'               => [[-1.1, -2.2, -3.3]],
    'indexed array with objects'                         => [[new stdClass(), new DateTime()]],
    // Objects
    'closure'                      => [fn (): Closure => function (): void {}],
    'closure that returns closure' => [fn (): Closure => function (): Closure {
        return function (): string {
            return 'foo';
        };
    }],
    'stdClass object'                                       => [new stdClass()],
    'DateTime object'                                       => [new DateTime()],
    'Exception object'                                      => [new Exception()],
    'anonyomus class'                                       => [new class {}],
    'anonyomous class that implements Stringable interface' => [new class implements Stringable {
        public function __toString(): string
        {
            return 'foo';
        }
    }],
    'anonyomous invokable class' => [new class {
        public function __invoke(): string
        {
            return 'foo';
        }
    }],
    'anonyomous class that extends from stdClass' => [new class extends stdClass {}],
    'anonyomus class that extends from Exception' => [new class extends Exception {}],
    // Resources
    'resource tmpfile()'           => [tmpfile()],
    'resource xml_parser_create()' => [xml_parser_create()],
]);
