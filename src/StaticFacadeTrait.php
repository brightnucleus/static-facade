<?php declare(strict_types = 1);
/**
 * Bright Nucleus Static Facade.
 *
 * Abstract static Facade class to wrap around shared object instances for convenient access.
 *
 * @package   BrightNucleus\StaticFacade
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.brightnucleus.com/
 * @copyright 2016 Alain Schlesser, Bright Nucleus
 */

namespace BrightNucleus\StaticFacade;

use BrightNucleus\Exception\BadMethodCallException;
use Exception;

/**
 * Trait StaticFacadeTrait.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\StaticFacade
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
trait StaticFacadeTrait
{

    /**
     * Forward a static call to the static Facade to the object instance that
     * this Facade is wrapping.
     *
     * @since 0.1.0
     *
     * @param string $method    Name of the method to call.
     * @param array  $arguments Array of arguments that were passed to the
     *                          method.
     *
     * @return mixed Result of the method call.
     * @throws Exception If the object instance does not have the requested
     *                          method.
     */
    public static function __callStatic($method, $arguments)
    {

        $instance = static::getFacadeInstance();

        if ( ! method_exists($instance, $method)) {
            throw static::getFacadeException($method, $arguments);
        }

        // Try to avoid `call_user_func_array()`, it is very slow.
        switch (count($arguments)) {
            case 0:
                return $instance->$method();
            case 1:
                return $instance->$method($arguments[0]);
            case 2:
                return $instance->$method($arguments[0], $arguments[1]);
            case 3:
                return $instance->$method($arguments[0], $arguments[1], $arguments[2]);
            case 4:
                return $instance->$method($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
            default:
                return call_user_func_array(
                    [$instance, $method],
                    $arguments
                );
        }
    }

    /**
     * Get the exception to throw when the object instance does not have the
     * requested method.
     *
     * Can be overridden in extending code.
     *
     * @since 0.1.0
     *
     * @param string $method    Name of the method to call.
     * @param array  $arguments Array of arguments that were passed to the
     *                          method.
     *
     * @return Exception
     */
    protected static function getFacadeException(string $method, array $arguments) : Exception
    {
        return new BadMethodCallException(
            sprintf(
                'Call to undefined method "%1$s" on class "%2$s" with arguments "%3$s".',
                $method,
                get_class(),
                json_encode($arguments)
            )
        );
    }
}