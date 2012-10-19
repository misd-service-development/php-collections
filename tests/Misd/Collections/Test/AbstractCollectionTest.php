<?php

namespace Misd\Collections\Test;

use PHPUnit_Framework_TestCase;

/**
 * Abstract collection test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class AbstractCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\AbstractCollection::__construct
     * @covers \Misd\Collections\AbstractCollection::toArray
     */
    public function testConstructorWithArray()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection', array(array('one', 'two')));
        $this->assertEquals(array('one', 'two'), $collection->toArray());
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::add
     */
    public function testAdd()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->add('test');
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::addAll
     */
    public function testAddAll()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->addAll(array('test'));
    }

    /**
     * @covers \Misd\Collections\AbstractCollection::contains
     */
    public function testContains()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection', array(array('one', 'two')));
        $this->assertTrue($collection->contains('two'));
        $this->assertFalse($collection->contains('three'));
    }

    /**
     * @covers \Misd\Collections\AbstractCollection::containsAll
     */
    public function testContainsAll()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection', array(array('one', 'two')));
        $this->assertTrue($collection->containsAll(array('one', 'two')));
        $this->assertFalse($collection->containsAll(array('two', 'three')));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::remove
     */
    public function testRemove()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->remove('test');
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::removeAll
     */
    public function testRemoveAll()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->removeAll(array('test'));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::retainAll
     */
    public function testRetainAll()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->retainAll(array('test'));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractCollection::clear
     */
    public function testClear()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $collection->clear();
    }

    /**
     * @covers \Misd\Collections\AbstractCollection::count
     */
    public function testCount()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection', array(array('one', 'two')));
        $this->assertEquals(2, $collection->count());
    }

    /**
     * @covers \Misd\Collections\AbstractCollection::isEmpty
     */
    public function testIsEmpty()
    {
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection');
        $this->assertTrue($collection->isEmpty());
        $collection = $this->getMockForAbstractClass('Misd\Collections\AbstractCollection', array(array('one', 'two')));
        $this->assertFalse($collection->isEmpty());
    }
}
