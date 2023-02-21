<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_resource;
use function get_resource_type;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating PHP resources.
 *
 * @method static mixed r(mixed $value, ?string $type = null, ?string $message = null) Alias of {@see Guard::isResource()}
 * @method static mixed resource(mixed $value, ?string $type = null, ?string $message = null) Alias of {@see Guard::isResource()}
 * @method static mixed is_resource(mixed $value, ?string $type = null, ?string $message = null) Alias of {@see Guard::isResource()}
 */
trait ResourceGuards
{
    /**
     * Validates if the given value is a resource and optionally of a
     * certain type and returns it.
     *
     * This method checks if a value is a resource and if the resource is of a certain type.
     * If the value is not a resource, an {@see InvalidGuardArgumentException} is thrown. If a
     * resource type is specified and the type of the resource does not match the specified
     * type, another {@see InvalidGuardArgumentException} is thrown.
     *
     * @param  mixed  $value The value to verify as a resource.
     * @param  string|null  $type The optional resource type to check the value against.
     * @param  string|null  $message The optional message to pass to the InvalidArgumentException if the value is not a resource.
     *
     * @return mixed The value if it is a resource of the specified type.
     *
     * @throws InvalidGuardArgumentException If the value is not a resource or if the resource type does not match the specified type.
     *
     * @see Alias: {@see Guard::r()}
     * @see Alias: {@see Guard::resource()}
     * @see Alias: {@see Guard::is_resource()}
     */
    #[Alias(['r', 'resource', 'is_resource'])]
    public static function isResource(mixed $value, ?string $type = null, ?string $message = null): mixed
    {
        if (!is_resource($value)) {
            return throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource. Got: %s (%s)',
                values: [self::valueToString(value: $value), self::valueToType(value: $value)],
            );
        }

        if ($type !== null && get_resource_type($value) !== $type) {
            return throw InvalidGuardArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource of type: %s. Got: %s',
                values: [$type, get_resource_type($value)],
            );
        }

        return $value;
    }
}
