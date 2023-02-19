<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Attributes;

use Attribute;

/**
 * This attribute/class is used to define one or more aliases for a method.
 *
 * @internal This class is not part of the public API and may change without notice.
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Alias
{
    /**
     * @param  string|array<string>  $alias
     */
    public function __construct(string|array $alias)
    {
    }
}
