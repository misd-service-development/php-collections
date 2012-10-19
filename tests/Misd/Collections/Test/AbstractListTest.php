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
 * Abstract list test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class AbstractListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractList::insert
     */
    public function testInsert()
    {
        $list = $this->getMockForAbstractClass('Misd\Collections\AbstractList');
        $list->insert(0, 'test');
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractList::insertAll
     */
    public function testInsertAll()
    {
        $list = $this->getMockForAbstractClass('Misd\Collections\AbstractList');
        $list->insertAll(0, array('test'));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractList::set
     */
    public function testSet()
    {
        $list = $this->getMockForAbstractClass('Misd\Collections\AbstractList');
        $list->set(0, 'test');
    }

    /**
     * @covers \Misd\Collections\AbstractList::get
     */
    public function testGet()
    {
        $objectOne = new TestObject();
        $objectOne->firstValue = 'one';

        $objectTwo = new TestObject();
        $objectTwo->secondValue = 'two';

        $list = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractList',
            array(array('one', 'two', $objectOne, $objectTwo))
        );

        $this->assertEquals('two', $list->get(1));
        $this->assertEquals($objectOne, $list->get(2));
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\AbstractList::get
     */
    public function testGetOutOfBoundsException()
    {
        $objectOne = new TestObject();
        $objectOne->firstValue = 'one';

        $objectTwo = new TestObject();
        $objectTwo->secondValue = 'two';

        $list = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractList',
            array(array('one', 'two', $objectOne, $objectTwo))
        );

        $list->get(4);
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractList::drop
     */
    public function testDrop()
    {
        $list = $this->getMockForAbstractClass('Misd\Collections\AbstractList');
        $list->drop(0);
    }

    /**
     * @covers \Misd\Collections\AbstractList::indexOf
     */
    public function testIndexOf()
    {
        $objectOne = new TestObject();
        $objectOne->firstValue = 'one';

        $objectTwo = new TestObject();
        $objectTwo->secondValue = 'two';

        $list = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractList',
            array(array('one', 'two', $objectOne, $objectOne))
        );

        $this->assertEquals(2, $list->indexOf($objectOne));
        $this->assertEquals(null, $list->indexOf($objectTwo));
    }

    /**
     * @covers \Misd\Collections\AbstractList::lastIndexOf
     */
    public function testLastIndexOf()
    {
        $objectOne = new TestObject();
        $objectOne->firstValue = 'one';

        $objectTwo = new TestObject();
        $objectTwo->secondValue = 'two';

        $list = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractList',
            array(array('one', 'two', $objectOne, $objectOne))
        );

        $this->assertEquals(3, $list->lastIndexOf($objectOne));
        $this->assertEquals(null, $list->lastIndexOf($objectTwo));
    }
}
