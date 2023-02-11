<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use function is_resource;
use function get_resource_type;
use EventMachinePHP\Guard\Attributes\Alias;
use EventMachinePHP\Guard\Exceptions\InvalidArgumentException;

/**
 * This trait contains methods for validating PHP resources.
 *
 * @method static mixed r(mixed $value, ?string $type = null, ?string $message = null) @see Guard::isResource()
 * @method static mixed resource(mixed $value, ?string $type = null, ?string $message = null) @see Guard::isResource()
 * @method static mixed is_resource(mixed $value, ?string $type = null, ?string $message = null) @see Guard::isResource()
 */
trait ResourceGuards
{
    /**
     * Determines if a given value is a PHP resource and optionally of a specific type.
     *
     * @param  mixed  $value The value to check if it is a resource.
     * @param  string|null  $type Optional. The expected type of the resource.
     * @param  string|null  $message Optional. A custom error message to use if the check fails.
     *
     * @return resource The value if it is a resource of the expected type.
     *
     * @throws InvalidArgumentException if the value is not a resource or if it is not of the expected type.
     *
     * @see Guard::r()
     * @see Guard::resource()
     * @see Guard::is_resource()
     */
    #[Alias(['r', 'resource', 'is_resource'])]
    public static function isResource(mixed $value, ?string $type = null, ?string $message = null): mixed
    {
        if (!is_resource($value)) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource. Got: %s (%s)',
                values: [self::valueToString($value), self::valueToType($value)],
            );
        }

        if ($type !== null && get_resource_type($value) !== $type) {
            return throw InvalidArgumentException::create(
                customMessage: $message,
                defaultMessage: 'Expected a resource of type: %s. Got: %s',
                values: [$type, get_resource_type($value)],
            );
        }

        return $value;
    }
}
