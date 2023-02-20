<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use Closure;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function expectExceptionMessage(Closure|string $message): void
    {
        if (is_string($message)) {
            parent::expectExceptionMessage($message);
        } else {
            $message = $message(...)->bindTo(test())(...test()->getProvidedData());

            if (is_array($message)) {
                $message = array_pop($message);
            }

            parent::expectExceptionMessage((string) $message);
        }
    }
}
