<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use BadMethodCallException;
use function call_user_func;

/**
 * @method static iterable isString(iterable $value, ?string $message = null) {@see Guard::isString()}
 * @method static iterable isGreaterThan(iterable $value, mixed $limit, ?string $message = null) {@see Guard::isGreaterThan()}
 */
class AllGuard
{
    private static ?AllGuard $instance = null;

    /**
     * Prevents direct instantiation.
     */
    private function __construct()
    {
    }

    public static function getInstance(): AllGuard
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

        $values = $arguments[array_key_first($arguments)];
        array_shift($arguments);

        foreach ($values as $value) {
            call_user_func([Guard::class, $name], $value, ...$arguments);
        }

        return $values;
    }
}
