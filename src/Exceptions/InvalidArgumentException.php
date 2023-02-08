<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException
{
    public static function create(
        ?string $customMessage = null,
        ?string $defaultMessage = null,
        ?array $values = null,
    ): self {
        return new self($customMessage ?: sprintf($defaultMessage, ...$values));
    }
}
