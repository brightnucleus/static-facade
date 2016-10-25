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

/**
 * Abstract class StaticFacade.
 *
 * @since   0.1.0
 *
 * @package BrightNucleus\StaticFacade
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class StaticFacade
{

    use StaticFacadeTrait;

    /**
     * Get the instance that this static Facade is wrapping.
     *
     * @since 0.1.0
     *
     * @return object
     */
    abstract protected static function getFacadeInstance();
}