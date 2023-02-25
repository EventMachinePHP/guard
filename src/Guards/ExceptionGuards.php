<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Guards;

use Exception;
use Throwable;
use EventMachinePHP\Guard\Guard;
use EventMachinePHP\Guard\Exceptions\InvalidGuardArgumentException;

/**
 * This trait contains methods for validating exceptions.
 *
 * @method static callable throws(callable $expression, mixed $classString = 'exception', ?string $message = null) Alias of {@see Guard::isThrowing()}
 * @method static callable throwing(callable $expression, mixed $classString = 'exception', ?string $message = null) Alias of {@see Guard::isThrowing()}
 * @method static callable exception(callable $expression, mixed $classString = 'exception', ?string $message = null) Alias of {@see Guard::isThrowing()}
 */
trait ExceptionGuards
{
    /**
     * Validates if the given expression throws an exception of the given class
     * and returns it.
     *
     * This method checks if the given expression throws an exception of the given
     * class. If it throws an exception, it returns the expression, otherwise, it
     * throws an InvalidGuardArgumentException with the given message or a default
     * message indicating that the expected exception was not thrown.
     *
     * @param  callable  $expression   The expression to evaluate.
     * @param  mixed  $classString  The expected class of the thrown exception.
     * @param  string|null  $message      Custom error message, if any.
     *
     * @return callable  The expression that was passed to the function.
     *
     * @see Alias: {@see Guard::throws()}
     * @see Alias: {@see Guard::throwing()}
     * @see Alias: {@see Guard::exception()}
     */
    #[Alias(['throws', 'throwing', 'exception'])]
    public static function isThrowing(callable $expression, mixed $classString = Exception::class, ?string $message = null): callable
    {
        Guard::isString($classString, $message);

        $exceptionClass = 'nothing';

        try {
            $expression();
        } catch (Exception|Throwable $exception) {
            if ($exception instanceof $classString) {
                return $expression;
            }

            $exceptionClass = $exception::class;
        }

        throw InvalidGuardArgumentException::create(
            customMessage: $message,
            defaultMessage: 'Expected to throw "%s", got "%s"',
            values: [$classString, $exceptionClass],
        );
    }
}
