<?php

/*
 * This file is part of the Collections library.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\Collections\Test;

use PHPUnit_Framework_TestCase;
use Misd\Collections\Test\Fixtures\TestObject;

/**
 * Abstract bag test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class AbstractBagTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractBag::addCopies
     */
    public function testAddCopies()
    {
        $bag = $this->getMockForAbstractClass('Misd\Collections\AbstractBag');
        $bag->addCopies('test', 2);
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractBag::setCopies
     */
    public function testSetCopies()
    {
        $bag = $this->getMockForAbstractClass('Misd\Collections\AbstractBag');
        $bag->setCopies('test', 2);
    }

    /**
     * @covers \Misd\Collections\AbstractBag::getCopies
     */
    public function testGetCopies()
    {
        $objectOne = new TestObject();
        $objectOne->firstValue = 'one';

        $objectTwo = new TestObject();
        $objectTwo->secondValue = 'two';

        $bag = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractBag',
            array(array('one', 'two', 'two', $objectOne, $objectTwo, $objectTwo))
        );

        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(2, $bag->getCopies('two'));
        $this->assertEquals(1, $bag->getCopies($objectOne));
        $this->assertEquals(2, $bag->getCopies($objectTwo));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractBag::removeCopies
     */
    public function testRemoveCopies()
    {
        $bag = $this->getMockForAbstractClass('Misd\Collections\AbstractBag');
        $bag->removeCopies('test', 2);
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractBag::removeAllCopies
     */
    public function testRemoveAllCopies()
    {
        $bag = $this->getMockForAbstractClass('Misd\Collections\AbstractBag');
        $bag->removeAllCopies('test');
    }
}
