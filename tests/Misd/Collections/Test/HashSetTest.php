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
use Misd\Collections\ArrayList,
    Misd\Collections\HashSet;
use Misd\Collections\Test\Fixtures\TestObject;

/**
 * Hash set test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class HashSetTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\HashSet::__construct
     * @covers \Misd\Collections\HashSet::toArray
     */
    public function testConstructorWithArray()
    {
        $set = new HashSet(array('one', 'two', 'two'));
        $this->assertEquals(array('one', 'two'), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::__construct
     */
    public function testConstructorWithCollection()
    {
        $collection = new ArrayList(array('one', 'two', 'two'));
        $set = new HashSet($collection);
        $this->assertEquals(array('one', 'two'), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::add
     */
    public function testAdd()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $set->add('five');

        $this->assertTrue($set->contains('five'));
    }

    /**
     * @covers \Misd\Collections\HashSet::add
     */
    public function testAddChaining()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->add('five'),
            '->add() returns a reference to the set'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::addAll
     */
    public function testAddAllWithArray()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $set->addAll(array('five', 'six'));

        $this->assertTrue($set->contains('five'));
        $this->assertTrue($set->contains('six'));
    }

    /**
     * @covers \Misd\Collections\HashSet::addAll
     */
    public function testAddAllWithCollection()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));
        $list = new ArrayList(array('five', 'six'));

        $set->addAll($list);

        $this->assertTrue($set->contains('five'));
        $this->assertTrue($set->contains('six'));
    }

    /**
     * @covers \Misd\Collections\HashSet::addAll
     */
    public function testAddAllChaining()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->addAll(array('five', 'six')),
            '->addAll() returns a reference to the list'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::contains
     */
    public function testContains()
    {
        $set = new HashSet(array('one', 'two'));
        $this->assertTrue($set->contains('two'));
        $this->assertFalse($set->contains('three'));
    }

    /**
     * @covers \Misd\Collections\HashSet::containsAll
     */
    public function testContainsAll()
    {
        $set = new HashSet(array('one', 'two'));
        $this->assertTrue($set->containsAll(array('one', 'two')));
        $this->assertFalse($set->containsAll(array('two', 'three')));
    }

    /**
     * @covers \Misd\Collections\HashSet::remove
     */
    public function testRemove()
    {
        $set = new HashSet(array('one', 'two'));

        $set->remove('two');

        $this->assertEquals(array('one'), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::remove
     */
    public function testRemoveNonexistent()
    {
        $set = new HashSet(array('one', 'two'));

        $set->remove('three');

        $this->assertEquals(array('one', 'two'), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::remove
     */
    public function testRemoveType()
    {
        $set = new HashSet(array(1, 2));

        $set->remove(2);

        $this->assertEquals(array(1), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::remove
     */
    public function testRemoveChaining()
    {
        $set = new HashSet(array('one', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->remove('two'),
            '->remove() returns a reference to the set'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::removeAll
     */
    public function testRemoveAllWithArray()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $set = new HashSet(array(1, 'two', 'three', $object1, $object2));

        $set->removeAll(array(1, 'three', 'four', $object1));

        $this->assertEquals(array('two', $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::removeAll
     */
    public function testRemoveAllWithSet()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $set = new HashSet(array(1, 'two', 'three', $object1, $object2));
        $set2 = new HashSet(array(1, 'three', 'four', $object1));

        $set->removeAll($set2);

        $this->assertEquals(array('two', $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::removeAll
     */
    public function testRemoveAllChaining()
    {
        $set = new HashSet(array('one', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->removeAll(array('two')),
            '->removeAll() returns a reference to the set'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::clear
     */
    public function testClear()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $set->clear();

        $this->assertEquals(0, $set->count());
    }

    /**
     * @covers \Misd\Collections\HashSet::clear
     */
    public function testClearChaining()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->clear(),
            '->clear() returns a reference to the set'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::retainAll
     */
    public function testRetainAllWithArray()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $set = new HashSet(array('one', 'two', 'three', 'four', $object1, $object2));

        $set->retainAll(array($object2, 'four', 'two'));

        $this->assertEquals(array('two', 'four', $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::retainAll
     */
    public function testRetainAllWithSet()
    {
        $object1 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object1->firstValue = 'one';
        $object2 = new \Misd\Collections\Test\Fixtures\TestObject();
        $object2->secondValue = 'two';

        $set = new HashSet(array('one', 'two', 'three', 'four', $object1, $object2));
        $set2 = new HashSet(array($object2, 'four', 'two'));

        $set->retainAll($set2);

        $this->assertEquals(array('two', 'four', $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\HashSet::retainAll
     */
    public function testRetainAllChaining()
    {
        $set = new HashSet(array('one', 'two', 'three', 'four'));

        $this->assertInstanceOf(
            'Misd\Collections\SetInterface',
            $set->retainAll(array('two', 'three')),
            '->retainAll() returns a reference to the set'
        );
    }

    /**
     * @covers \Misd\Collections\HashSet::getIterator
     */
    public function testGetIterator()
    {
        $set = new HashSet();
        $this->assertInstanceOf('Traversable', $set->getIterator());
    }
}
