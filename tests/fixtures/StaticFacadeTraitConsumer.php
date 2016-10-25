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

namespace BrightNucleus\StaticFacade\Tests;

use BrightNucleus\Exception\BadMethodCallException;
use BrightNucleus\StaticFacade\StaticFacadeTrait;
use DateTimeImmutable;
use Exception;

/**
 * Class StaticFacadeTraitConsumer.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\StaticFacade
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class StaticFacadeTraitConsumer
{

    use StaticFacadeTrait;

    /**
     * Get the instance that this static Facade is wrapping.
     *
     * @since 0.1.0
     *
     * @return object
     */
    protected static function getFacadeInstance()
    {
        return DateTimeImmutable::createFromFormat('!Y-m-d', '1955-11-05');
    }

    /**
     * Get the exception to throw when the object instance does not have the
     * requested method.
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
        return new BadMethodCallException('Great Scott!');
    }
}