<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Exceptions;

class NullOrGuardExceptionGuard extends InvalidGuardArgumentException
{
    public static function fromException(InvalidGuardArgumentException $exception): self
    {
        $message = str_replace('Expected ', 'Expected null or ', $exception->getMessage());

        return new self($message);
    }
}
