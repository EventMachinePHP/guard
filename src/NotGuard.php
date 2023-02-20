<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use BadMethodCallException;
use function call_user_func;
use EventMachinePHP\Guard\Exceptions\NotGuardException;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * @method static string isString(mixed $value, ?string $message = null) Opposite of {@see Guard::isString()}
 */
class NotGuard
{
    private static ?NotGuard $instance = null;

    /**
     * Prevents direct instantiation.
     */
    private function __construct()
    {
    }

    public static function getInstance(): NotGuard
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws \EventMachinePHP\Guard\Exceptions\NotGuardException
     */
    public function __call(string $name, array $arguments)
    {
        if (!method_exists(Guard::class, $name)) {
            throw new BadMethodCallException("Guard::{$name}() does not exist");
        }

        try {
            call_user_func([Guard::class, $name], ...$arguments);

            throw new NotGuardException(sprintf('Expected %s() to fail, but not failed.', $name));
        } catch (InvalidGuardArgumentException) {
            return $arguments[array_key_first($arguments)];
        }
    }
}
