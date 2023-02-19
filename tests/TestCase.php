<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests;

use Closure;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Assert that a closure throws a InvalidArgumentException
     * exception and with a given message.
     *
     * @param  Closure  $callable The closure to test.
     */
    public function expectInvalidArgumentException(Closure $callable): void
    {
        $message = $callable(...)->bindTo(test())(...test()->getProvidedData());

        $this->expectException(InvalidGuardArgumentException::class);
        $this->expectExceptionMessage($message);
    }

    public function expectExceptionMessage(Closure|string $message): void
    {
        if (is_string($message)) {
            parent::expectExceptionMessage($message);
        } else {
            $message = $message(...)->bindTo(test())(...test()->getProvidedData());
            $message = array_pop($message);

            parent::expectExceptionMessage((string) $message);
        }
    }
}
