<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\GuardedTypes;

use EventMachinePHP\Guard\Guard;

class BooleanValue extends GuardedType
{
    public function __construct(
        private mixed $value
    ) {
        Guard::isBoolean(value: $value);
    }

    public static function make(mixed $value): BooleanValue
    {
        return new self($value);
    }

    public function __isset(string $name): bool
    {
        return $name === 'value';
    }

    public function __set(string $name, $value): void
    {
        if ($name !== 'value') {
            return;
        }

        Guard::isBoolean($value);

        $this->value = $value;
    }

    public function __get(string $name): bool
    {
        return $this->value;
    }

    // TODO: make $value's default value = NullValue
    public function __invoke($value = null): bool
    {
        if ($value === null) {
            return $this->value;
        }

        return Guard::isBoolean($value);
    }
}
