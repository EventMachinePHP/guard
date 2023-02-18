<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use BadMethodCallException;
use InvalidArgumentException;
use EventMachinePHP\Guard\Exceptions\NotGuardException;
use function call_user_func;

/**
 * @method static string isString(mixed $value, ?string $message = null) Opposite of {@see Guard::isString()}
 */
class NotGuard
{
    private static ?NotGuard $instance = null;

    /**
     * Prevents direct instantiation
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
            throw new BadMethodCallException(sprintf('Method %s does not exist', $name));
        }

        try {
            call_user_func([Guard::class, $name], ...$arguments);

            throw new NotGuardException(sprintf('Expected %s() to fail, but not failed.', $name));
        } catch (InvalidArgumentException) {
            return $arguments[array_key_first($arguments)];
        }
    }
}
