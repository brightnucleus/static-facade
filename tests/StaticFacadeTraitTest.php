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
use BrightNucleus\StaticFacade\Tests\StaticFacadeTraitConsumer;

/**
 * Class StaticFacadeTraitTest.
 *
 * @since  0.1.0
 *
 * @author Alain Schlesser <alain.schlesser@gmail.com>
 */
class StaticFacadeTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test whether the trait can forward a method call.
     *
     * @since 0.1.0
     */
    public function testTraitCanForwardMethodCall()
    {
        $timestamp = StaticFacadeTraitConsumer::getTimestamp();
        $this->assertEquals(strtotime('05-11-1955'), $timestamp);
    }

    /**
     * Test whether the trait will throw an exception on a missing method call.
     *
     * @since 0.1.0
     */
    public function testTraitThrowsExceptionOnMissingMethodCall()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Great Scott!');
        StaticFacadeTraitConsumer::unknownMethod();
    }
}
