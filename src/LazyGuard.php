<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard;

use function sprintf;
use BadMethodCallException;
use function method_exists;
use function call_user_func;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * @method static \EventMachinePHP\Guard\LazyGuard isInteger(?string $message = null) {@see Guard::isInteger()}
 * @method static \EventMachinePHP\Guard\LazyGuard isNumeric(?string $message = null) {@see Guard::isNumeric()}
 * @method static \EventMachinePHP\Guard\LazyGuard isPositiveInteger(?string $message = null) {@see Guard::isPositiveInteger()}
 * @method static \EventMachinePHP\Guard\LazyGuard isGreaterThan(mixed $limit, ?string $message = null) {@see Guard::isGreaterThan()}
 */
class LazyGuard
{
    private array $methodCalls = [];

    /**
     * Prevents direct instantiation.
     */
    public function __construct(protected mixed $value)
    {
    }

    /**
     * @throws \EventMachinePHP\Guard\Exceptions\NotGuardException
     */
    public function __call(string $name, array $arguments)
    {
        if (!method_exists(Guard::class, $name)) {
            throw new BadMethodCallException(sprintf('Method %s does not exist', $name));
        }

        $this->methodCalls[] = $name;

        call_user_func([Guard::class, $name], $this->value, ...$arguments);

        return $this;
    }

    public function validate(): mixed
    {
//        if (count($this->methodCalls) === 0) {
//            throw new InvalidGuardArgumentException(
//                'No guard method called',
//                'No guard method called on %s',
//                [$this->value]
//            );
//        }

        return $this->value;
    }
}
