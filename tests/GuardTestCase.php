<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use Closure;
use DateTime;
use stdClass;
use Countable;
use Exception;
use Stringable;
use ArrayAccess;
use Traversable;
use JsonSerializable;
use IteratorAggregate;

enum GuardTestCase: string
{
    // region Nulls
    case N001_NULL          = 'N001|Null';
    case N002_NULL_NEGATIVE = 'N002|-Null';
    // endregion

    // region Booleans
    case B001_BOOLEAN_TRUE  = 'B001|Boolean: true';
    case B002_BOOLEAN_FALSE = 'B002|Boolean: false';
    // endregion

    // region Integers
    case I001_INTEGER_MAX                    = 'I001|Integer: MAX';
    case I002_INTEGER_MIN                    = 'I002|Integer: MIN';
    case I003_INTEGER_BIG                    = 'I003|Integer: Big Positive';
    case I004_INTEGER_BIG_NEGATIVE           = 'I004|Integer: Big Negative';
    case I005_INTEGER_1337                   = 'I005|Integer: 1337';
    case I006_INTEGER_1337_NEGATIVE          = 'I006|Integer: -1337';
    case I007_INTEGER_1                      = 'I007|Integer: 1';
    case I008_INTEGER_1_NEGATIVE             = 'I008|Integer: -1';
    case I009_INTEGER_2                      = 'I009|Integer: 2';
    case I010_INTEGER_2_NEGATIVE             = 'I010|Integer: -2';
    case I011_INTEGER_0                      = 'I011|Integer: 0';
    case I012_INTEGER_0_NEGATIVE             = 'I012|Integer: -0';
    case I013_INTEGER_BOOLEAN_TRUE_NEGATIVE  = 'I013|Integer: Boolean -true';
    case I014_INTEGER_BOOLEAN_TRUE_POSTIVE   = 'I014|Integer: Boolean +true';
    case I015_INTEGER_BOOLEAN_FALSE_NEGATIVE = 'I015|Integer: Boolean -false';
    case I016_INTEGER_BOOLEAN_FALSE_POSITIVE = 'I016|Integer: Boolean +false';
    // endregion

    // region Floats
    case F001_FLOAT_MAX                    = 'F001|Float: MAX';
    case F002_FLOAT_MIN                    = 'F002|Float: MIN';
    case F003_FLOAT_1337_43057             = 'F003|Float: 1337.43057';
    case F004_FLOAT_1337_43057_NEGATIVE    = 'F004|Float: -1337.43057';
    case F005_FLOAT_0                      = 'F005|Float: 0';
    case F006_FLOAT_0_NEGATIVE             = 'F006|Float: -0';
    case F007_FLOAT_0_1                    = 'F007|Float: 0.1';
    case F008_FLOAT_0_1_NEGATIVE           = 'F008|Float: -0.1';
    case F009_FLOAT_0_00000000001          = 'F009|Float: 0.00000000001';
    case F010_FLOAT_0_00000000001_NEGATIVE = 'F010|Float: -0.00000000001';
    case F011_FLOAT_1E10                   = 'F011|Float: 1.0e+10';
    case F012_FLOAT_1E10_NEGATIVE          = 'F012|Float: -1.0e+10';
    // endregion

    // region Strings
    case S001_STRING_EMPTY                        = 'S001|String: Empty';
    case S002_STRING_SPACE_1                      = 'S002|String: 1 Space';
    case S003_STRING_SPACE_2                      = 'S003|String: 2 Space';
    case S004_STRING_SPACE_3                      = 'S004|String: 3 Space';
    case S005_STRING_DEFAULT                      = 'S005|String: Default';
    case S006_STRING_LOWERCASE                    = 'S006|String: Lowercase';
    case S007_STRING_UPPERCASE                    = 'S007|String: Uppercase';
    case S008_STRING_SENTENCE_CAMEL               = 'S008|String: Camelcase (Sentence)';
    case S009_STRING_SENTENCE_PASCAL              = 'S009|String: Pascalcase (Sentence)';
    case S000_STRING_SENTENCE_SNAKE               = 'S000|String: Snakecase (Sentence)';
    case S011_STRING_SENTENCE_ADA                 = 'S011|String: Adacase (Sentence)';
    case S012_STRING_SENTENCE_MACRO               = 'S012|String: Macrocase (Sentence)';
    case S013_STRING_SENTENCE_KEBAB               = 'S013|String: Kebabcase (Sentence)';
    case S014_STRING_SENTENCE_TRAIN               = 'S014|String: Traincase (Sentence)';
    case S015_STRING_SENTENCE_COBOL               = 'S015|String: Cobolcase (Sentence)';
    case S016_STRING_SENTENCE_LOWER               = 'S016|String: Lowercase (Sentence)';
    case S017_STRING_SENTENCE_UPPER               = 'S017|String: Uppercase (Sentence)';
    case S018_STRING_SENTENCE_TITLE               = 'S018|String: Titlecase (Sentence)';
    case S019_STRING_SENTENCE_SENTENCE            = 'S019|String: Sentencecase (Sentence)';
    case S020_STRING_SENTENCE_DOT                 = 'S020|String: Dotcase (Sentence)';
    case S021_STRING_WITH_NUMBERS                 = 'S021|String: With Numbers';
    case S022_STRING_SPECIALS                     = 'S022|String: Specials';
    case S023_STRING_AROUND_SPACES                = 'S023|String: Around Spaces';
    case S024_STRING_WITH_NEWLINE                 = 'S024|String: With Newline';
    case S025_STRING_UTF8                         = 'S025|String: UTF8';
    case S026_STRING_UTF8_EXTENDED                = 'S026|String: UTF8 Extended';
    case S027_STRING_EMOJIS                       = 'S027|String: Emojis';
    case S028_STRING_ACCENTED                     = 'S028|String: Accented';
    case S029_STRING_HTML_ENTITIES                = 'S029|String: HTML Entities';
    case S030_STRING_SPACES_TABS_NEW_LINE         = 'S030|String: Spaces, Tabs, New Line';
    case S031_STRING_CONTROL_CHARACTERS           = 'S031|String: Control Characters';
    case S032_STRING_NULL_BYTE                    = 'S032|String: Null Byte';
    case S033_STRING_LONG                         = 'S033|String: Long';
    case S034_STRING_JSON                         = 'S034|String: JSON';
    case S035_STRING_JSON_INVALID                 = 'S035|String: JSON Invalid';
    case S036_STRING_1_COMMA_ZERO                 = 'S036|String: 1,0';
    case S037_STRING_1_SLASH_ZERO                 = 'S037|String: 1/0';
    case S038_STRING_1_SPACE_ZERO                 = 'S038|String: 1 0';
    case S039_STRING_NULL_VALUE                   = 'S039|String: Null Value';
    case S040_STRING_NULL_NEGATIVE_VALUE          = 'S040|String: Null Negative Value';
    case S041_STRING_BOOLEAN_TRUE                 = 'S041|String: Boolean True Value';
    case S042_STRING_BOOLEAN_TRUE_NEGATIVE        = 'S042|String: Boolean True Negative Value';
    case S043_STRING_BOOLEAN_FALSE                = 'S043|String: Boolean False Value';
    case S044_STRING_BOOLEAN_FALSE_NEGATIVE       = 'S044|String: Boolean False Negative Value';
    case S045_STRING_INTEGER_MAX                  = 'S045|String: Interger Max';
    case S046_STRING_INTEGER_MIN                  = 'S046|String: Interger Min';
    case S047_STRING_INTEGER_BIG                  = 'S047|String: Integer Big';
    case S048_STRING_INTEGER_BIG_NEGATIVE         = 'S048|String: -Integer Big';
    case S049_STRING_INTEGER_1337                 = 'S049|String: Integer 1337';
    case S050_STRING_INTEGER_1337_NEGATIVE        = 'S050|String: Integer -1337';
    case S051_STRING_INTEGER_1                    = 'S051|String: Integer 1';
    case S052_STRING_INTEGER_1_NEGATIVE           = 'S052|String: Integer -1';
    case S053_STRING_INTEGER_2                    = 'S053|String: Integer 2';
    case S054_STRING_INTEGER_2_NEGATIVE           = 'S054|String: Integer -2';
    case S055_STRING_INTEGER_0                    = 'S055|String: Integer 0';
    case S056_STRING_INTEGER_0_NEGATIVE           = 'S056|String: Integer -0';
    case S057_STRING_FLOAT_MAX                    = 'S057|String: Float Max';
    case S058_STRING_FLOAT_MIN                    = 'S058|String: Float Min';
    case S059_STRING_FLOAT_1337_43057             = 'S059|String: Float 1337.43057';
    case S060_STRING_FLOAT_1337_43057_NEGATIVE    = 'S060|String: Float -1337.43057';
    case S061_STRING_FLOAT_0                      = 'S061|String: Float 0.0';
    case S062_STRING_FLOAT_0_NEGATIVE             = 'S062|String: Float -0.0';
    case S063_STRING_FLOAT_0_1                    = 'S063|String: Float 0.1';
    case S064_STRING_FLOAT_0_1_NEGATIVE           = 'S064|String: Float -0.1';
    case S065_STRING_FLOAT_0_00000000001          = 'S065|String: Float 0.00000000001';
    case S066_STRING_FLOAT_0_00000000001_NEGATIVE = 'S066|String: Float -0.00000000001';
    case S067_STRING_FLOAT_1E10                   = 'S067|String: Float 1.0e+10';
    case S068_STRING_FLOAT_1E10_NEGATIVE          = 'S068|String: Float -1.0e+10';
    case S069_STRING_ARRAY_EMPTY                  = 'S069|String: Array Empty';
    case S070_STRING_ARRAY                        = 'S070|String: Array';
    // endregion

    // region Arrays
    case A001_ARRAY_EMPTY                            = 'A001|Array: Empty';
    case A002_ARRAY_INTEGER_INDEXED                  = 'A002|Array: Integer Indexed';
    case A003_ARRAY_INGEGER_NEGATIVE_INDEXED         = 'A003|Array: Negative Integer Indexed';
    case A004_ARRAY_FLOAT_INDEXED                    = 'A004|Array: Float Indexed';
    case A005_ARRAY_FLOAT_NEGATIVE_INDEXED           = 'A005|Array: Negative Float Indexed';
    case A006_ARRAY_BOOLEAN_TRUE_INDEXED             = 'A006|Array: Boolean True Indexed';
    case A007_ARRAY_BOOLEAN_FALSE_INDEXED            = 'A007|Array: Boolean False Indexed';
    case A008_ARRAY_ASSOCIATIVE_NULL_WITH_EMPTY_KEY  = 'A008|Array: Associative Null With Empty Key';
    case A009_ARRAY_ASSOCIATIVE_EMPTY_WITH_EMPTY_KEY = 'A009|Array: Associative Empty With Empty Key';
    case A010_ARRAY_ASSOCIATIVE_EMPTY                = 'A010|Array: Associative Empty';
    case A011_ARRAY_NULL_VALUE                       = 'A011|Array: Null Value';
    case A012_ARRAY_ASSOCIATIVE_NULL_VALUE           = 'A012|Array: Associative Null Value';
    case A013_ARRAY_FALSE_VALUE                      = 'A013|Array: False Value';
    case A014_ARRAY_ASSOCIATIVE_FALSE_VALUE          = 'A014|Array: Associative False Value';
    case A015_ARRAY_TRUE_AND_FALSE                   = 'A015|Array: True and False';
    case A016_ARRAY_ASSOCIATIVE_TRUE_AND_FALSE       = 'A016|Array: Associative True and False';
    case A017_ARRAY_NULL_TRUE_FALSE                  = 'A017|Array: Null True False';
    case A018_ARRAY_ASSOCIATIVE_NULL_TRUE_FALSE      = 'A018|Array: Associative Null True False';
    case A019_ARRAY_ZERO                             = 'A019|Array: 0';
    case A020_ARRAY_ASSOCIATIVE_ZERO                 = 'A020|Array: Associative 0';
    case A021_ARRAY_NEGATIVE_ZERO                    = 'A021|Array: -0';
    case A022_ARRAY_FLOAT_ZER0                       = 'A022|Array: 0.0';
    case A023_ARRAY_FLOAT_ZER0_NEGATIVE              = 'A023|Array: -0.0';
    case A024_ARRAY_POSITIVE_INTEGERS                = 'A024|Array: Positive Integers';
    case A025_ARRAY_NEGATIVE_INTEGERS                = 'A025|Array: Negative Integers';
    case A026_ARRAY_NEGATIVE_FLOATS                  = 'A026|Array: Negative Floats';
    case A027_ARRAY_STRINGS                          = 'A027|Array: Array with Strings';
    case A028_ARRAY_STRINGS_AND_INTEGERS             = 'A028|Array: Array with Strings and Integers';
    case A029_ARRAY_STRING_AND_NUMERIC_ONE           = 'A029|Array: Array with String and Numeric One';
    case A030_ARRAY_BOOLEAN_AND_STRING_ONE           = 'A030|Array: Array with Boolean and String One';
    case A031_ARRAY_NULL_AND_FALSE                   = 'A031|Array: Array with Null and False';
    case A032_ARRAY_REPEATED_STRINGS                 = 'A032|Array: Array with Repeated Strings';
    case A033_ARRAY_REPEATED_INTEGERS                = 'A033|Array: Array with Repeated Integers';
    case A034_ARRAY_REPEATED_FLOATS                  = 'A034|Array: Array with Repeated Floats';
    case A035_ARRAY_REPEATED_BOOLEANS                = 'A035|Array: Array with Repeated Booleans';
    case A036_ARRAY_REPEATED_OBJECTS                 = 'A036|Array: Array with Repeated Objects';
    case A037_ARRAY_OBJECTS                          = 'A037|Array: Objects';
    // endregion

    // region Objects
    case O001_OBJECT_CLOSURE                           = 'O001|Object: Closure';
    case O002_OBJECT_CLOSURE_RETURNS_CLOSURE           = 'O002|Object: Closure Returns Closure';
    case O003_OBJECT_STDCLASS                          = 'O003|Object: stdClass';
    case O004_OBJECT_DATETIME                          = 'O004|Object: DateTime';
    case O005_OBJECT_EXCEPTION                         = 'O005|Object: Exception';
    case O006_OBJECT_ANONYMOUS_CLASS                   = 'O006|Object: Anonymous Class';
    case O007_OBJECT_ANONYMOUS_STRINGABLE_CLASS        = 'O007|Object: Anonymous Stringable Class';
    case O008_OBJECT_ANONYMOUS_INVOKABLE_CLASS         = 'O008|Object: Anonymous Invokable Class';
    case O009_OBJECT_ANONYMOUS_ITERABLE_CLASS          = 'O009|Object: Anonymous Iterable Class';
    case O010_OBJECT_ANONYMOUS_ARRAY_ACCESS_CLASS      = 'O010|Object: Anonymous ArrayAccess Class';
    case O011_OBJECT_ANONYMOUS_COUNTABLE_CLASS         = 'O011|Object: Anonymous Countable Class';
    case O012_OBJECT_ANONYMOUS_JSON_SERIALIZABLE_CLASS = 'O012|Object: Anonymous JsonSerializable Class';
    case O013_OBJECT_ANONYMOUS_CLASS_EXTENDS_STDCLASS  = 'O013|Object: Anonymous Class Extends stdClass';
    case O014_OBJECT_ANONYMOUS_CLASS_EXTENDS_DATETIME  = 'O014|Object: Anonymous Class Extends DateTime';
    case O015_OBJECT_ANONYMOUS_CLASS_EXTENDS_EXCEPTION = 'O015|Object: Anonymous Class Extends Exception';
    // endregion

    // region Resources
    case R001_RESOURCE_TMPFILE = 'R001|Resource';
    // endregion

    public static function case(GuardTestCase $case): mixed
    {
        return match ($case) {
            // region Nulls
            self::N001_NULL          => null,
            self::N002_NULL_NEGATIVE => -null,
            // endregion

            // region Booleans
            self::B001_BOOLEAN_TRUE  => true,
            self::B002_BOOLEAN_FALSE => false,
            // endregion

            // region Integers
            self::I001_INTEGER_MAX                    => PHP_INT_MAX,
            self::I002_INTEGER_MIN                    => PHP_INT_MIN,
            self::I003_INTEGER_BIG                    => 9999999999999999999999999999999999999,
            self::I004_INTEGER_BIG_NEGATIVE           => -9999999999999999999999999999999999999,
            self::I005_INTEGER_1337                   => 1337,
            self::I006_INTEGER_1337_NEGATIVE          => -1337,
            self::I007_INTEGER_1                      => 1,
            self::I008_INTEGER_1_NEGATIVE             => -1,
            self::I009_INTEGER_2                      => 2,
            self::I010_INTEGER_2_NEGATIVE             => -2,
            self::I011_INTEGER_0                      => 0,
            self::I012_INTEGER_0_NEGATIVE             => -0,
            self::I013_INTEGER_BOOLEAN_TRUE_NEGATIVE  => -true,
            self::I014_INTEGER_BOOLEAN_TRUE_POSTIVE   => +true,
            self::I015_INTEGER_BOOLEAN_FALSE_NEGATIVE => -false,
            self::I016_INTEGER_BOOLEAN_FALSE_POSITIVE => +false,
            // endregion

            // region Floats
            self::F001_FLOAT_MAX                    => PHP_FLOAT_MAX,
            self::F002_FLOAT_MIN                    => PHP_FLOAT_MIN,
            self::F003_FLOAT_1337_43057             => 1337.43057,
            self::F004_FLOAT_1337_43057_NEGATIVE    => -1337.43057,
            self::F005_FLOAT_0                      => 0.0,
            self::F006_FLOAT_0_NEGATIVE             => -0.0,
            self::F007_FLOAT_0_1                    => 0.1,
            self::F008_FLOAT_0_1_NEGATIVE           => -0.1,
            self::F009_FLOAT_0_00000000001          => 0.00000000001,
            self::F010_FLOAT_0_00000000001_NEGATIVE => -0.00000000001,
            self::F011_FLOAT_1E10                   => 1.0e+10,
            self::F012_FLOAT_1E10_NEGATIVE          => -1.0e+10,
            // endregion

            // region Strings
            self::S001_STRING_EMPTY                        => '',
            self::S002_STRING_SPACE_1                      => ' ',
            self::S003_STRING_SPACE_2                      => '  ',
            self::S004_STRING_SPACE_3                      => '   ',
            self::S005_STRING_DEFAULT                      => 'Leet',
            self::S006_STRING_LOWERCASE                    => 'leet',
            self::S007_STRING_UPPERCASE                    => 'LEET',
            self::S008_STRING_SENTENCE_CAMEL               => 'myNameIsYunusEmreDeligöz',
            self::S009_STRING_SENTENCE_PASCAL              => 'MyNameIsYunusEmreDeligöz',
            self::S000_STRING_SENTENCE_SNAKE               => 'my_name_is_yunus_emre_deligöz',
            self::S011_STRING_SENTENCE_ADA                 => 'My_Name_Is_Yunus_Emre_Deligöz',
            self::S012_STRING_SENTENCE_MACRO               => 'MY_NAME_IS_YUNUS_EMRE_DELİGÖZ',
            self::S013_STRING_SENTENCE_KEBAB               => 'my-name-is-yunus-emre-deligöz',
            self::S014_STRING_SENTENCE_TRAIN               => 'My-Name-Is-Yunus-Emre-Deligöz',
            self::S015_STRING_SENTENCE_COBOL               => 'MY-NAME-IS-YUNUS-EMRE-DELİGÖZ',
            self::S016_STRING_SENTENCE_LOWER               => 'my name is yunus emre deligöz',
            self::S017_STRING_SENTENCE_UPPER               => 'MY NAME IS YUNUS EMRE DELİGÖZ',
            self::S018_STRING_SENTENCE_TITLE               => 'My Name Is Yunus Emre Deligöz',
            self::S019_STRING_SENTENCE_SENTENCE            => 'My name is yunus emre deligöz',
            self::S020_STRING_SENTENCE_DOT                 => 'my.name.is.yunus.emre.deligöz',
            self::S021_STRING_WITH_NUMBERS                 => 'B1ff',
            self::S022_STRING_SPECIALS                     => 'B1!!f0',
            self::S023_STRING_AROUND_SPACES                => ' l33t ',
            self::S024_STRING_WITH_NEWLINE                 => "Hello\nworld!",
            self::S025_STRING_UTF8                         => 'Hello, 世界!',
            self::S026_STRING_UTF8_EXTENDED                => 'The quick brôwn fôx jumped over the lazy dôg.',
            self::S027_STRING_EMOJIS                       => '😀😂🤣😊😍',
            self::S028_STRING_ACCENTED                     => 'áéíóúñ',
            self::S029_STRING_HTML_ENTITIES                => '&lt;b&gt;Bold&lt;/b&gt;',
            self::S030_STRING_SPACES_TABS_NEW_LINE         => "  \tleet\t\n",
            self::S031_STRING_CONTROL_CHARACTERS           => "\n\t\r",
            self::S032_STRING_NULL_BYTE                    => "\0",
            self::S033_STRING_LONG                         => 'A String longer than 300 characters. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies lacinia, nisl nunc aliquet massa, nec lacin, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor, nisl eget ultricies lacinia, nisl nunc aliquet massa, nec lacin',
            self::S034_STRING_JSON                         => '{"name1": "Alice", "name2": "Bob"}',
            self::S035_STRING_JSON_INVALID                 => '{"name": "Alice", "name": "Bob"}',
            self::S036_STRING_1_COMMA_ZERO                 => '1,0',
            self::S037_STRING_1_SLASH_ZERO                 => '1/0',
            self::S038_STRING_1_SPACE_ZERO                 => '1 0',
            self::S039_STRING_NULL_VALUE                   => 'null',
            self::S040_STRING_NULL_NEGATIVE_VALUE          => '-null',
            self::S041_STRING_BOOLEAN_TRUE                 => 'true',
            self::S042_STRING_BOOLEAN_TRUE_NEGATIVE        => '-true',
            self::S043_STRING_BOOLEAN_FALSE                => 'false',
            self::S044_STRING_BOOLEAN_FALSE_NEGATIVE       => '-false',
            self::S045_STRING_INTEGER_MAX                  => 'PHP_INT_MAX',
            self::S046_STRING_INTEGER_MIN                  => 'PHP_INT_MIN',
            self::S047_STRING_INTEGER_BIG                  => '9999999999999999999999999999999999999',
            self::S048_STRING_INTEGER_BIG_NEGATIVE         => '-9999999999999999999999999999999999999',
            self::S049_STRING_INTEGER_1337                 => '1337',
            self::S050_STRING_INTEGER_1337_NEGATIVE        => '-1337',
            self::S051_STRING_INTEGER_1                    => '1',
            self::S052_STRING_INTEGER_1_NEGATIVE           => '-1',
            self::S053_STRING_INTEGER_2                    => '2',
            self::S054_STRING_INTEGER_2_NEGATIVE           => '-2',
            self::S055_STRING_INTEGER_0                    => '0',
            self::S056_STRING_INTEGER_0_NEGATIVE           => '-0',
            self::S057_STRING_FLOAT_MAX                    => 'PHP_FLOAT_MAX',
            self::S058_STRING_FLOAT_MIN                    => 'PHP_FLOAT_MIN',
            self::S059_STRING_FLOAT_1337_43057             => '1337.43057',
            self::S060_STRING_FLOAT_1337_43057_NEGATIVE    => '-1337.43057',
            self::S061_STRING_FLOAT_0                      => '0.0',
            self::S062_STRING_FLOAT_0_NEGATIVE             => '-0.0',
            self::S063_STRING_FLOAT_0_1                    => '0.1',
            self::S064_STRING_FLOAT_0_1_NEGATIVE           => '-0.1',
            self::S065_STRING_FLOAT_0_00000000001          => '0.00000000001',
            self::S066_STRING_FLOAT_0_00000000001_NEGATIVE => '-0.00000000001',
            self::S067_STRING_FLOAT_1E10                   => '1.0e+10',
            self::S068_STRING_FLOAT_1E10_NEGATIVE          => '-1.0e+10',
            self::S069_STRING_ARRAY_EMPTY                  => '[]',
            self::S070_STRING_ARRAY                        => '[1, 2, 3]',
            // endregion

            // region Arrays
            self::A001_ARRAY_EMPTY                            => [],
            self::A002_ARRAY_INTEGER_INDEXED                  => [0 => []],
            self::A003_ARRAY_INGEGER_NEGATIVE_INDEXED         => [-0 => []],
            self::A004_ARRAY_FLOAT_INDEXED                    => [0.0 => []],
            self::A005_ARRAY_FLOAT_NEGATIVE_INDEXED           => [-0.0 => []],
            self::A006_ARRAY_BOOLEAN_TRUE_INDEXED             => [true => []],
            self::A007_ARRAY_BOOLEAN_FALSE_INDEXED            => [false => []],
            self::A008_ARRAY_ASSOCIATIVE_NULL_WITH_EMPTY_KEY  => ['' => null],
            self::A009_ARRAY_ASSOCIATIVE_EMPTY_WITH_EMPTY_KEY => ['' => []],
            self::A010_ARRAY_ASSOCIATIVE_EMPTY                => ['empty' => []],
            self::A011_ARRAY_NULL_VALUE                       => [null],
            self::A012_ARRAY_ASSOCIATIVE_NULL_VALUE           => ['null' => null],
            self::A013_ARRAY_FALSE_VALUE                      => [false],
            self::A014_ARRAY_ASSOCIATIVE_FALSE_VALUE          => ['false' => false],
            self::A015_ARRAY_TRUE_AND_FALSE                   => [true, false],
            self::A016_ARRAY_ASSOCIATIVE_TRUE_AND_FALSE       => ['true, false' => true, false],
            self::A017_ARRAY_NULL_TRUE_FALSE                  => [null, true, false],
            self::A018_ARRAY_ASSOCIATIVE_NULL_TRUE_FALSE      => ['null, true, false' => null, true, false],
            self::A019_ARRAY_ZERO                             => [0],
            self::A020_ARRAY_ASSOCIATIVE_ZERO                 => ['0' => 0],
            self::A021_ARRAY_NEGATIVE_ZERO                    => [-0],
            self::A022_ARRAY_FLOAT_ZER0                       => [0.0],
            self::A023_ARRAY_FLOAT_ZER0_NEGATIVE              => [-0.0],
            self::A024_ARRAY_POSITIVE_INTEGERS                => [1, 2, 3],
            self::A025_ARRAY_NEGATIVE_INTEGERS                => [-1, -2, -3],
            self::A026_ARRAY_NEGATIVE_FLOATS                  => [-1.1, -2.2, -3.3],
            self::A027_ARRAY_STRINGS                          => ['a', 'b', 'c'],
            self::A028_ARRAY_STRINGS_AND_INTEGERS             => ['a', 'b', 'c', 1, 2, 3],
            self::A029_ARRAY_STRING_AND_NUMERIC_ONE           => [1, '1'],
            self::A030_ARRAY_BOOLEAN_AND_STRING_ONE           => [true, '1'],
            self::A031_ARRAY_NULL_AND_FALSE                   => [null, false],
            self::A032_ARRAY_REPEATED_STRINGS                 => ['a', 'a', 'a'],
            self::A033_ARRAY_REPEATED_INTEGERS                => [1, 1, 1],
            self::A034_ARRAY_REPEATED_FLOATS                  => [1.0, 1.0, 1.0],
            self::A035_ARRAY_REPEATED_BOOLEANS                => [true, true, true],
            self::A036_ARRAY_REPEATED_OBJECTS                 => [new DateTime(), new DateTime(), new DateTime()],
            self::A037_ARRAY_OBJECTS                          => [new stdClass(), new DateTime()],
            // endregion

            // region Objects
            self::O001_OBJECT_CLOSURE => fn (): Closure => function (): void {
            },
            self::O002_OBJECT_CLOSURE_RETURNS_CLOSURE => fn (): Closure => function (): Closure {
                return function (): string {
                    return 'foo';
                };
            },
            self::O003_OBJECT_STDCLASS        => new stdClass(),
            self::O004_OBJECT_DATETIME        => new DateTime(),
            self::O005_OBJECT_EXCEPTION       => new Exception(),
            self::O006_OBJECT_ANONYMOUS_CLASS => new class {
            },
            self::O007_OBJECT_ANONYMOUS_STRINGABLE_CLASS => new class implements Stringable {
                public function __toString(): string
                {
                    return 'foo';
                }
            },
            self::O008_OBJECT_ANONYMOUS_INVOKABLE_CLASS => new class {
                public function __invoke(): string
                {
                    return 'foo';
                }
            },
            self::O009_OBJECT_ANONYMOUS_ITERABLE_CLASS => new class implements IteratorAggregate {
                public function getIterator(): Traversable
                {
                    yield 'foo';
                }
            },
            self::O010_OBJECT_ANONYMOUS_ARRAY_ACCESS_CLASS => new class implements ArrayAccess {
                public function offsetExists($offset): bool
                {
                    return true;
                }

                public function offsetGet($offset): string
                {
                    return 'foo';
                }

                public function offsetSet($offset, $value): void
                {
                }

                public function offsetUnset($offset): void
                {
                }
            },
            self::O011_OBJECT_ANONYMOUS_COUNTABLE_CLASS => new class implements Countable {
                public function count(): int
                {
                    return 1;
                }
            },
            self::O012_OBJECT_ANONYMOUS_JSON_SERIALIZABLE_CLASS => new class implements JsonSerializable {
                public function jsonSerialize(): string
                {
                    return 'foo';
                }
            },
            self::O013_OBJECT_ANONYMOUS_CLASS_EXTENDS_STDCLASS => new class extends stdClass {
            },
            self::O014_OBJECT_ANONYMOUS_CLASS_EXTENDS_DATETIME => new class extends DateTime {
            },
            self::O015_OBJECT_ANONYMOUS_CLASS_EXTENDS_EXCEPTION => new class extends Exception {
            },
            // endregion

            // region Resources
            self::R001_RESOURCE_TMPFILE => tmpfile(),
            // endregion
        };
    }
}
