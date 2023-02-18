<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use BadMethodCallException;
use function method_exists;
use function call_user_func;
use function array_key_first;
use EventMachinePHP\Guard\Exceptions\NullOrGuardExceptionGuard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * @method static string isString(mixed $value, ?string $message = null) Similar to {@see Guard::isString()}
 */
class NullOrGuard
{
    private static ?NullOrGuard $instance = null;

    /**
     * Prevents direct instantiation.
     */
    private function __construct()
    {
    }

    public static function getInstance(): NullOrGuard
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
        if ($arguments[array_key_first($arguments)] === null) {
            return null;
        }

        if (!method_exists(Guard::class, $name)) {
            throw new BadMethodCallException("Guard::{$name}() does not exist");
        }

        try {
            return call_user_func([Guard::class, $name], ...$arguments);
        } catch (InvalidGuardArgumentException $exception) {
            throw NullOrGuardExceptionGuard::fromException($exception);
        }
    }
}
