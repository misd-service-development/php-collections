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
     * @expectedException \OutOfBoundsException
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

    /**
     * @covers \Misd\Collections\ArrayList::subList
     * @covers \Misd\Collections\SubArrayList::factory
     */
    public function testSubList()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf('Misd\Collections\ListInterface', $list->subList(0, 2));

        $emptySubList = $list->subList(0, 0);
        $this->assertTrue($emptySubList->isEmpty());

        $subList = $list->subList(0, 2);
        $this->assertEquals(array('one', 'two'), $subList->toArray());

        $subSubList = $list->subList(1, 2);
        $this->assertEquals(array('two'), $subSubList->toArray());
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::subList
     */
    public function testSubListOutOfBoundsExceptionOnNegativeFromIndex()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->subList(-1, 2);
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::subList
     */
    public function testSubListOutOfBoundsExceptionOnReversedIndices()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->subList(1, 0);
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\ArrayList::subList
     */
    public function testSubListOutOfBoundsExceptionOnNonExistentToIndex()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));

        $list->subList(2, 5);
    }

    /**
     * @covers \Misd\Collections\SubArrayList::add
     */
    public function testSubListAdd()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 3);
        $subSubList = $subList->subList(0, 1);

        $list->add('list');
        $subList->add('subList');
        $subSubList->add('subSubList');

        $this->assertEquals(
            array('one', 'two', 'subSubList', 'three', 'subList', 'four', 'five', 'list'),
            $list->toArray()
        );
        $this->assertEquals(array('two', 'subSubList', 'three', 'subList'), $subList->toArray());
        $this->assertEquals(array('two', 'subSubList'), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::add
     */
    public function testSubListAddChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->add('test'),
            '->add() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::addAll
     */
    public function testSubListAddAll()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 3);
        $subSubList = $subList->subList(0, 1);

        $list->addAll(array('list'));
        $subList->addAll(array('subList'));
        $subSubList->addAll(array('subSubList'));

        $this->assertEquals(
            array('one', 'two', 'subSubList', 'three', 'subList', 'four', 'five', 'list'),
            $list->toArray()
        );
        $this->assertEquals(array('two', 'subSubList', 'three', 'subList'), $subList->toArray());
        $this->assertEquals(array('two', 'subSubList'), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::addAll
     */
    public function testSubListAddAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->addAll(array('test')),
            '->addAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::insert
     * @covers \Misd\Collections\ArrayList::insert
     */
    public function testSubListInsert()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 3);
        $subSubList = $subList->subList(0, 1);

        $list->insert(3, 'list');
        $subList->insert(2, 'subList');
        $subSubList->insert(1, 'subSubList');

        $this->assertEquals(
            array('one', 'two', 'subSubList', 'three', 'subList', 'list', 'four', 'five'),
            $list->toArray()
        );
        $this->assertEquals(array('two', 'subSubList', 'three', 'subList', 'list'), $subList->toArray());
        $this->assertEquals(array('two', 'subSubList'), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::insert
     */
    public function testSubListInsertChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->insert(1, 'test'),
            '->insert() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::insertAll
     * @covers \Misd\Collections\ArrayList::insertAll
     */
    public function testSubListInsertAll()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 3);
        $subSubList = $subList->subList(0, 1);

        $list->insertAll(3, array('list'));
        $subList->insertAll(2, array('subList'));
        $subSubList->insertAll(1, array('subSubList'));

        $this->assertEquals(
            array('one', 'two', 'subSubList', 'three', 'subList', 'list', 'four', 'five'),
            $list->toArray()
        );
        $this->assertEquals(array('two', 'subSubList', 'three', 'subList', 'list'), $subList->toArray());
        $this->assertEquals(array('two', 'subSubList'), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::insertAll
     */
    public function testSubListInsertAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->insertAll(1, array('test')),
            '->insertAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::set
     * @covers \Misd\Collections\ArrayList::set
     */
    public function testSubListSet()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $list->set(2, 'list');
        $subList->set(2, 'subList');
        $subSubList->set(0, 'subSubList');

        $this->assertEquals(
            array('one', 'subSubList', 'list', 'subList', 'five'),
            $list->toArray()
        );
        $this->assertEquals(array('subSubList', 'list', 'subList'), $subList->toArray());
        $this->assertEquals(array('subSubList'), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::set
     */
    public function testSubListSetChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->set(1, 'test'),
            '->set() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::get
     */
    public function testSubListGet()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $this->assertEquals('three', $subList->get(1));
        $this->assertEquals('two', $subSubList->get(0));
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\SubArrayList::get
     */
    public function testSubListGetOutOfBoundsExceptionOnNegativeIndex()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);

        $subList->get(-1);
    }

    /**
     * @expectedException \OutOfBoundsException
     * @covers \Misd\Collections\SubArrayList::get
     */
    public function testSubListGetOutOfBoundsExceptionOnNonExistentIndex()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);

        $subList->get(4);
    }

    /**
     * @covers \Misd\Collections\SubArrayList::remove
     */
    public function testSubListRemove()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 2);

        $list->remove('two');
        $subList->remove('four');
        $subSubList->remove('three');

        $this->assertEquals(array('one', 'five'), $list->toArray());
        $this->assertTrue($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::remove
     */
    public function testSubListRemoveNonexistent()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);

        $subList->remove('five');

        $this->assertEquals(array('one', 'two', 'three', 'four', 'five'), $list->toArray());
        $this->assertEquals(array('two', 'three', 'four'), $subList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::remove
     */
    public function testSubListRemoveType()
    {
        $list = new ArrayList(array(1, '2', 2, '2', 2));
        $subList = $list->subList(2, 5);

        $subList->remove(2);

        $this->assertEquals(array(1, '2', '2', 2), $list->toArray());
        $this->assertEquals(array('2', 2), $subList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::remove
     */
    public function testSubListRemoveChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->remove('two'),
            '->remove() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::removeAll
     */
    public function testSubListRemoveAllWithArray()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));
        $subList = $list->subList(2, 7);
        $subSubList = $subList->subList(2, 4);

        $list->removeAll(array(1, 'three', 'four', $object1));

        $this->assertEquals(array('1', 'two', 'two', $object2), $list->toArray());
        $this->assertEquals(array('two'), $subList->toArray());
        $this->assertTrue($subSubList->isEmpty());

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));
        $subList = $list->subList(2, 7);
        $subSubList = $subList->subList(2, 4);

        $subList->removeAll(array('two', $object1));
        $subSubList->removeAll(array('three'));

        $this->assertEquals(array('1', $object2), $list->toArray());
        $this->assertTrue($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::removeAll
     */
    public function testSubListRemoveAllWithList()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'two';

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));
        $subList = $list->subList(2, 7);
        $subSubList = $subList->subList(2, 4);

        $list->removeAll(new ArrayList(array(1, 'three', 'four', $object1)));

        $this->assertEquals(array('1', 'two', 'two', $object2), $list->toArray());
        $this->assertEquals(array('two'), $subList->toArray());
        $this->assertTrue($subSubList->isEmpty());

        $list = new ArrayList(array('1', 'two', 'two', 'three', 'three', 'three', $object1, $object2));
        $subList = $list->subList(2, 7);
        $subSubList = $subList->subList(2, 4);

        $subList->removeAll(new ArrayList(array('two', $object1)));
        $subSubList->removeAll(new ArrayList(array('three')));

        $this->assertEquals(array('1', $object2), $list->toArray());
        $this->assertTrue($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::removeAll
     */
    public function testSubListRemoveAllChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->removeAll(array('two')),
            '->removeAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::drop
     * @covers \Misd\Collections\ArrayList::drop
     */
    public function testSubListDrop()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $list->drop(2);
        $subList->drop(1);
        $subSubList->drop(0);

        $this->assertEquals(
            array('one', 'five'),
            $list->toArray()
        );
        $this->assertEquals(array(), $subList->toArray());
        $this->assertEquals(array(), $subSubList->toArray());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::drop
     */
    public function testSubListDropChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->drop(1),
            '->drop() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::clear
     */
    public function testSubListClear()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $list->clear();

        $this->assertTrue($list->isEmpty());
        $this->assertTrue($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());

        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $subList->clear();

        $this->assertEquals(array('one', 'five'), $list->toArray());
        $this->assertTrue($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());

        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 1);

        $subSubList->clear();

        $this->assertEquals(array('one', 'three', 'four', 'five'), $list->toArray());
        $this->assertEquals(array('three', 'four'), $subList->toArray());
        $this->assertTrue($subSubList->isEmpty());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::clear
     */
    public function testSubListClearChaining()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four'));
        $subList = $list->subList(1, 3);

        $this->assertInstanceOf(
            'Misd\Collections\ListInterface',
            $subList->clear(),
            '->clear() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\SubArrayList::count
     */
    public function testSubListCount()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 2);

        $this->assertEquals(5, $list->count());
        $this->assertEquals(3, $subList->count());
        $this->assertEquals(2, $subSubList->count());

        $subSubList->clear();

        $this->assertEquals(3, $list->count());
        $this->assertEquals(1, $subList->count());
        $this->assertEquals(0, $subSubList->count());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::isEmpty
     */
    public function testSubListIsEmpty()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(0, 2);

        $this->assertFalse($list->isEmpty());
        $this->assertFalse($subList->isEmpty());
        $this->assertFalse($subSubList->isEmpty());

        $subSubList->clear();

        $this->assertFalse($list->isEmpty());
        $this->assertFalse($subList->isEmpty());
        $this->assertTrue($subSubList->isEmpty());
    }

    /**
     * @covers \Misd\Collections\SubArrayList::toArray
     */
    public function testSubListToArray()
    {
        $list = new ArrayList(array('one', 'two', 'three', 'four', 'five'));
        $subList = $list->subList(1, 4);
        $subSubList = $subList->subList(1, 2);

        $this->assertEquals(array(0 => 'one', 1 => 'two', 2 => 'three', 3 => 'four', 4 => 'five'), $list->toArray());
        $this->assertEquals(array(0 => 'two', 1 => 'three', 2 => 'four'), $subList->toArray());
        $this->assertEquals(array(0 => 'three'), $subSubList->toArray());
    }
}
