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
use Misd\Collections\ArrayList;
use Misd\Collections\Test\Fixtures\TestObject;

/**
 * Array list test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class ArrayListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\ArrayList::add
     */
    public function testAdd()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->add('five');

        $this->assertEquals(array(0 => 'one', 1 => 'two', 2 => 'three', 3 => 'four', 4 => 'five'), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::add
     */
    public function testAddChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->add('five'),
            '->add() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::addAll
     */
    public function testAddAllWithArray()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->addAll(array('five', 'six'));

        $this->assertEquals(
            array(0 => 'one', 1 => 'two', 2 => 'three', 3 => 'four', 4 => 'five', 5 => 'six'),
            $list->toArray()
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::addAll
     */
    public function testAddAllWithList()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $list2 = new ArrayList(array('five', 'six'));

        $list->addAll($list2);

        $this->assertEquals(
            array(0 => 'one', 1 => 'two', 2 => 'three', 3 => 'four', 4 => 'five', 5 => 'six'),
            $list->toArray()
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::addAll
     */
    public function testAddAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->addAll(array('five')),
            '->addAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::insert
     */
    public function testInsert()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->insert(1, 'five');

        $this->assertEquals(array(0 => 'one', 1 => 'five', 2 => 'two', 3 => 'three', 4 => 'four'), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::insert
     */
    public function testInsertChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->insert(1, 'five'),
            '->insert() returns a reference to the list'
        );
    }

    /**
     * @expectedException  \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::insert
     */
    public function testInsertOutOfBoundsException()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->insert(5, 'five');
    }

    /**
     * @covers \Misd\Collections\ArrayList::insertAll
     */
    public function testInsertAllWithArray()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->insertAll(1, array('five', 'six'));

        $this->assertEquals(
            array(0 => 'one', 1 => 'five', 2 => 'six', 3 => 'two', 4 => 'three', 5 => 'four'),
            $list->toArray()
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::insertAll
     */
    public function testInsertAllWithList()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $list2 = new ArrayList(array('five', 'six'));

        $list->insertAll(1, $list2);

        $this->assertEquals(
            array(0 => 'one', 1 => 'five', 2 => 'six', 3 => 'two', 4 => 'three', 5 => 'four'),
            $list->toArray()
        );
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::insertAll
     */
    public function testInsertAllOutOfBoundsException()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->insertAll(5, array('five', 'six'));
    }

    /**
     * @covers \Misd\Collections\ArrayList::insertAll
     */
    public function testInsertAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->insert(1, array('five', 'six')),
            '->insertAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::set
     */
    public function testSet()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->set(1, 'five');

        $this->assertEquals(array(0 => 'one', 1 => 'five', 2 => 'three', 3 => 'four'), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::set
     */
    public function testSetChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->set(1, 'five'),
            '->set() returns a reference to the list'
        );
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::set
     */
    public function testSetOutOfBoundsException()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->set(4, 'five');
    }

    /**
     * @covers \Misd\Collections\ArrayList::remove
     */
    public function testRemove()
    {
        $list = new ArrayList(array('one', 'two', 'two'));

        $list->remove('two');

        $this->assertEquals(array(0 => 'one', 1 => 'two'), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::remove
     */
    public function testRemoveNonexistent()
    {
        $list = new ArrayList(array('one', 'two', 'two'));

        $list->remove('three');

        $this->assertEquals(array(0 => 'one', 1 => 'two', 2 => 'two'), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::remove
     */
    public function testRemoveType()
    {
        $list = new ArrayList(array(1, '2', 2, '2', 2));

        $list->remove(2);

        $this->assertEquals(array(0 => 1, 1 => '2', 2 => '2', 3 => 2), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::remove
     */
    public function testRemoveChaining()
    {
        $list = new ArrayList(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->remove('two'),
            '->remove() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::removeAll
     */
    public function testRemoveAllWithArray()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));

        $list->removeAll(array(1, 'three', 'four', $object1));

        $this->assertEquals(array(0 => '1', 1 => 'two', 2 => 'two', 3 => $object2), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::removeAll
     */
    public function testRemoveAllWithList()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));
        $list2 = new ArrayList(array(1, 'three', 'four', $object1));

        $list->removeAll($list2);

        $this->assertEquals(array(0 => '1', 1 => 'two', 2 => 'two', 3 => $object2), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::removeAll
     */
    public function testRemoveAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->removeAll(array('two')),
            '->removeAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::drop
     */
    public function testDrop()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->drop(2);

        $this->assertEquals(array(0 => 'one', 1 => 'two', 2 => 'four'), $list->toArray());
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::drop
     */
    public function testDropOutOfBoundsException()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->drop(4);
    }

    /**
     * @covers \Misd\Collections\ArrayList::drop
     */
    public function testDropChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->drop(1),
            '->drop() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::clear
     */
    public function testClear()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->clear();

        $this->assertEquals(0, $list->count());
    }

    /**
     * @covers \Misd\Collections\ArrayList::clear
     */
    public function testClearChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->clear(),
            '->clear() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\ArrayList::retainAll
     */
    public function testRetainAllWithArray()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 3, 'four', $object1, $object2));

        $list->retainAll(array(1, 3, 'two', $object1));

        $this->assertEquals(array(0 => 'two', 1 => 3, 2 => $object1), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::retainAll
     */
    public function testRetainAllWithList()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 3, 'four', $object1, $object2));
        $list2 = new ArrayList(array(1, 3, 'two', $object1));

        $list->retainAll($list2);

        $this->assertEquals(array(0 => 'two', 1 => 3, 2 => $object1), $list->toArray());
    }

    /**
     * @covers \Misd\Collections\ArrayList::retainAll
     */
    public function testRetainAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $list->retainAll(array('two', 'three')),
            '->retainAll() returns a reference to the list'
        );
    }
}
