<?php

namespace EventMachinePHP\Guard\Exceptions;

class InvalidArgumentException extends \InvalidArgumentException
{
    public static function create(string $message): self
    {
        return new self($message);
    }
}
