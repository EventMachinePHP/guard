<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Exceptions;

use InvalidArgumentException;
use EventMachinePHP\Guard\ExceptionMessage;

class InvalidGuardArgumentException extends InvalidArgumentException
{
    public static function create(
        string|ExceptionMessage $defaultMessage,
        ?string $customMessage = null,
        ?array $values = null,
    ): self {
        if ($customMessage !== null) {
            return new self($customMessage);
        }

        $defaultMessage = is_string($defaultMessage) ? $defaultMessage : $defaultMessage->value;
        $message        = $defaultMessage.' '.ExceptionMessage::ValueMessage->value;

        return new self(sprintf($message, ...$values));
    }
}
