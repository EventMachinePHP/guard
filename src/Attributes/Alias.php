<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Attributes;

use Attribute;

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
