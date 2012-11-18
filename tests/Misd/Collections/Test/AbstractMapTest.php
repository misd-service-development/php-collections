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

use ReflectionMethod, DateTime;
use PHPUnit_Framework_TestCase;
use Misd\Collections\Test\Fixtures\TestObject;
use Misd\Collections\ArrayList,
    Misd\Collections\HashMap;

class AbstractMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\AbstractMap::__construct
     */
    public function testConstructorWithArray()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap', array(array('one', 'two')));
        $this->assertEquals(array(0 => 'one', 1 => 'two'), $map->values()->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::__construct
     */
    public function testConstructorWithAssociativeArray()
    {
        $object = new TestObject();

        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array(1, 'two' => 2, 'object' => $object))
        );
        $this->assertEquals(array(0, 'two', 'object'), $map->keySet()->toArray());
        $this->assertEquals(array(1, 2, $object), $map->values()->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::__construct
     */
    public function testConstructorWithMap()
    {
        $object = new TestObject();

        $hashMap = new HashMap(array('one' => 1, 'two' => 2));
        $hashMap->put($object, 'object');

        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap', array($hashMap));
        $this->assertEquals(array('one', 'two', $object), $map->keySet()->toArray());
        $this->assertEquals(array(1, 2, 'object'), $map->values()->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::hashKey
     */
    public function testHashKey()
    {
        $method = new \ReflectionMethod('Misd\Collections\AbstractMap', 'hashKey');
        $method->setAccessible(true);
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $this->assertTrue(is_string($method->invoke($map, 'test')));
        $this->assertTrue(is_int($method->invoke($map, 1)));
        $this->assertTrue(is_string($method->invoke($map, new TestObject())));
        $this->assertTrue(is_string($method->invoke($map, new DateTime())));
        $this->assertTrue(is_string($method->invoke($map, false)));
        $this->assertTrue(is_string($method->invoke($map, true)));
        $this->assertTrue(is_string($method->invoke($map, null)));
        $this->assertTrue(is_string($method->invoke($map, array('one', 'two'))));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractMap::put
     */
    public function testPut()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $map->put('test', 'test');
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractMap::putAll
     */
    public function testPutAll()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $map->putAll(array('one' => 'one', 'two' => 'two'));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::get
     */
    public function testGet()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertEquals(2, $map->get('two'));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::get
     */
    public function testGetNonExistent()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertNull($map->get('three'));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractMap::remove
     */
    public function testRemove()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $map->remove('test');
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractMap::removeAll
     */
    public function testRemoveAll()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $map->removeAll(array('one', 'two'));
    }

    /**
     * @expectedException \Misd\Collections\Exception\UnsupportedOperationException
     * @covers \Misd\Collections\AbstractMap::clear
     */
    public function testClear()
    {
        $map = $this->getMockForAbstractClass('Misd\Collections\AbstractMap');
        $map->clear();
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsKey
     */
    public function testContainsKey()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertTrue($map->containsKey('two'));
        $this->assertFalse($map->containsKey('three'));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsKeys
     */
    public function testContainsKeysWithArray()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertTrue($map->containsKeys(array('one', 'two')));
        $this->assertFalse($map->containsKey(array('two', 'three')));
        $this->assertFalse($map->containsKey(array('three', 'four')));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsKeys
     */
    public function testContainsKeysWithCollection()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertTrue($map->containsKeys(new ArrayList(array('one', 'two'))));
        $this->assertFalse($map->containsKey(new ArrayList(array('two', 'three'))));
        $this->assertFalse($map->containsKey(new ArrayList(array('three', 'four'))));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsValue
     */
    public function testContainsValue()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertTrue($map->containsValue(2));
        $this->assertFalse($map->containsValue(3));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsValues
     */
    public function testContainsValuesWithArray()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 'two'))
        );
        $this->assertTrue($map->containsValues(array(1, 'two')));
        $this->assertFalse($map->containsValues(array('two', 3)));
        $this->assertFalse($map->containsValues(array(3, 4)));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::containsValues
     */
    public function testContainsValuesWithCollection()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 'two'))
        );
        $this->assertTrue($map->containsValues(new ArrayList(array(1, 'two'))));
        $this->assertFalse($map->containsValues(new ArrayList(array('two', 3))));
        $this->assertFalse($map->containsValues(new ArrayList(array(3, 4))));
    }

    /**
     * @covers \Misd\Collections\AbstractMap::count
     */
    public function testCount()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertEquals(2, $map->count());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::isEmpty
     */
    public function testIsEmpty()
    {
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap'
        );
        $this->assertTrue($map->isEmpty());
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 2))
        );
        $this->assertFalse($map->isEmpty());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::keySet
     */
    public function testKeySet()
    {
        $object = new TestObject();
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 'two', 2 => $object))
        );

        $this->assertInstanceOf('Misd\Collections\SetInterface', $map->keySet());
        $this->assertEquals(array('one', 'two', 2), $map->keySet()->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractMap::values
     */
    public function testValues()
    {
        $object = new TestObject();
        $map = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractMap',
            array(array('one' => 1, 'two' => 'two', 2 => $object))
        );

        $this->assertInstanceOf('Misd\Collections\ListInterface', $map->values());
        $this->assertEquals(array(1, 'two', $object), $map->values()->toArray());
    }
}
