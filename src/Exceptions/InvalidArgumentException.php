<?php

namespace EventMachinePHP\Guard\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException
{
    public static function create(?string $customMessage = null, ?string $defaultMessage = null, mixed ...$sprintfValues): self
    {
        return new self($customMessage ?: sprintf($defaultMessage, ...$sprintfValues));
    }
}
