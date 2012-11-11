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
    Misd\Collections\HashBag;
use Misd\Collections\Test\Fixtures\TestObject;

/**
 * Hash bag test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class HashBagTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\HashBag::__construct
     * @covers \Misd\Collections\HashBag::add
     * @covers \Misd\Collections\HashBag::addAll
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testConstructorWithArray()
    {
        $bag = new HashBag(array('one', 'two', 'two'));
        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(2, $bag->getCopies('two'));
        $this->assertEquals(0, $bag->getCopies('three'));
    }

    /**
     * @covers \Misd\Collections\HashBag::__construct
     * @covers \Misd\Collections\HashBag::add
     * @covers \Misd\Collections\HashBag::addAll
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testConstructorWithCollection()
    {
        $collection = new ArrayList(array('one', 'two', 'two'));
        $bag = new HashBag($collection);
        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(2, $bag->getCopies('two'));
        $this->assertEquals(0, $bag->getCopies('three'));
    }

    /**
     * @covers \Misd\Collections\HashBag::addCopies
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testAddCopies()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'second';

        $bag = new HashBag(array('one', 'two', 'two'));
        $bag->addCopies('one', 1);
        $bag->addCopies('three', 3);
        $bag->addCopies($object1, 1);
        $bag->addCopies($object2, 2);

        $this->assertEquals(2, $bag->getCopies('one'));
        $this->assertEquals(2, $bag->getCopies('two'));
        $this->assertEquals(3, $bag->getCopies('three'));
        $this->assertEquals(1, $bag->getCopies($object1));
        $this->assertEquals(2, $bag->getCopies($object2));
    }

    /**
     * @covers \Misd\Collections\HashBag::addCopies
     */
    public function testAddCopiesChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->addCopies('three', 3),
            '->addCopies() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::setCopies
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testSetCopies()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'second';

        $bag = new HashBag(array('one', 'two', 'two'));
        $bag->setCopies('one', 2);
        $bag->setCopies('two', 0);
        $bag->setCopies('three', 3);
        $bag->setCopies($object1, 1);
        $bag->setCopies($object2, 2);

        $this->assertEquals(2, $bag->getCopies('one'));
        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(3, $bag->getCopies('three'));
        $this->assertEquals(1, $bag->getCopies($object1));
        $this->assertEquals(2, $bag->getCopies($object2));
    }

    /**
     * @covers \Misd\Collections\HashBag::setCopies
     */
    public function testSetCopiesChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->setCopies('three', 3),
            '->setCopies() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::contains
     */
    public function testContains()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'second';

        $bag = new HashBag(array('one', 'two', 'two', $object1));

        $this->assertTrue($bag->contains('one'));
        $this->assertTrue($bag->contains('two'));
        $this->assertFalse($bag->contains('three'));
        $this->assertTrue($bag->contains($object1));
        $this->assertFalse($bag->contains($object2));
    }

    /**
     * @covers \Misd\Collections\HashBag::containsAll
     */
    public function testContainsAll()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'second';

        $bag = new HashBag(array('one', 'two', 'two', $object1));

        $this->assertTrue($bag->containsAll(array('one', 'two')));
        $this->assertTrue($bag->containsAll(array($object1)));
        $this->assertFalse($bag->containsAll(array('two', 'three')));
        $this->assertFalse($bag->containsAll(array($object2)));
    }

    /**
     * @covers \Misd\Collections\HashBag::remove
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRemove()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $bag->remove('one');
        $bag->remove('two');
        $bag->remove('three');

        $this->assertEquals(0, $bag->getCopies('one'));
        $this->assertEquals(1, $bag->getCopies('two'));
        $this->assertEquals(0, $bag->getCopies('three'));
    }

    /**
     * @covers \Misd\Collections\HashBag::removeCopies
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRemoveCopies()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $bag->removeCopies('two', 2);
        $bag->removeCopies('three', 2);
        $bag->removeCopies('four', 4);

        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(1, $bag->getCopies('three'));
        $this->assertEquals(0, $bag->getCopies('four'));
    }

    /**
     * @covers \Misd\Collections\HashBag::removeCopies
     */
    public function testRemoveCopiesChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->removeCopies('two', 2),
            '->removeCopies() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::removeAllCopies
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRemoveAllCopies()
    {
        $bag = new HashBag(array('three', 'three', 'three'));

        $bag->removeAllCopies('three');
        $bag->removeAllCopies('four');

        $this->assertEquals(0, $bag->getCopies('three'));
        $this->assertEquals(0, $bag->getCopies('four'));
    }

    /**
     * @covers \Misd\Collections\HashBag::removeAllCopies
     */
    public function testRemoveAllCopiesChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->removeAllCopies('two'),
            '->removeAllCopies() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::removeAll
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRemoveAll()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $bag->removeAll(array('two', 'three', 'four'));

        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(0, $bag->getCopies('three'));
        $this->assertEquals(0, $bag->getCopies('four'));
    }

    /**
     * @covers \Misd\Collections\HashBag::removeAll
     */
    public function testRemoveAllChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->removeAll(array('two')),
            '->removeAll() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::retainAll
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRetainAllWithArray()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $bag->retainAll(array('one', 'three', 'four'));

        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(3, $bag->getCopies('three'));
        $this->assertEquals(0, $bag->getCopies('four'));
    }

    /**
     * @covers \Misd\Collections\HashBag::retainAll
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testRetainAllWithCollection()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $collection = new ArrayList(array('one', 'three', 'four'));

        $bag->retainAll($collection);

        $this->assertEquals(1, $bag->getCopies('one'));
        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(3, $bag->getCopies('three'));
        $this->assertEquals(0, $bag->getCopies('four'));
    }

    /**
     * @covers \Misd\Collections\HashBag::retainAll
     */
    public function testRetainAllChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->retainAll(array('two')),
            '->retainAll() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::clear
     * @covers \Misd\Collections\HashBag::getCopies
     */
    public function testClear()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $bag->clear();

        $this->assertEquals(0, $bag->getCopies('one'));
        $this->assertEquals(0, $bag->getCopies('two'));
        $this->assertEquals(0, $bag->getCopies('three'));
    }

    /**
     * @covers \Misd\Collections\HashBag::clear
     */
    public function testClearChaining()
    {
        $bag = new HashBag(array('one', 'two', 'two'));

        $this->assertInstanceOf(
            'Misd\Collections\BagInterface',
            $bag->clear(),
            '->clear() returns a reference to the bag'
        );
    }

    /**
     * @covers \Misd\Collections\HashBag::count
     */
    public function testCount()
    {
        $bag = new HashBag();
        $this->assertEquals(0, $bag->count());

        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));
        $this->assertEquals(6, $bag->count());
    }

    /**
     * @covers \Misd\Collections\HashBag::isEmpty
     */
    public function testIsEmpty()
    {
        $bag = new HashBag();
        $this->assertTrue($bag->isEmpty());

        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));
        $this->assertFalse($bag->isEmpty());
    }

    /**
     * @covers \Misd\Collections\HashBag::toArray
     */
    public function testToArray()
    {
        $bag = new HashBag(array('one', 'two', 'two', 'three', 'three', 'three'));

        $this->assertEquals(array('one', 'two', 'two', 'three', 'three', 'three'), $bag->toArray());
    }
}
