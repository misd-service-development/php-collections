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
use Misd\Collections\HashMap;
use Misd\Collections\Test\Fixtures\TestObject;

/**
 * Hash map test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class HashMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\HashMap::put
     */
    public function testPut()
    {
        $object = new TestObject();
        $map = new HashMap();

        $map->put('key', 'value');
        $map->put($object, 'object');

        $this->assertEquals('value', $map->get('key'));
        $this->assertEquals('object', $map->get($object));
    }

    /**
     * @covers \Misd\Collections\HashMap::put
     */
    public function testPutChaining()
    {
        $map = new HashMap();

        $this->assertInstanceOf(
            'Misd\Collections\MapInterface',
            $map->put('key', 'value'),
            '->put() returns a reference to the map'
        );
    }

    /**
     * @covers \Misd\Collections\HashMap::putAll
     */
    public function testPutAllWithArray()
    {
        $map = new HashMap();

        $map->putAll(array('key' => 'value'));

        $this->assertEquals('value', $map->get('key'));
    }

    /**
     * @covers \Misd\Collections\HashMap::putAll
     */
    public function testPutAllWithMap()
    {
        $map = new HashMap();
        $map2 = new HashMap(array('key' => 'value'));

        $map->putAll($map2);

        $this->assertEquals('value', $map->get('key'));
    }

    /**
     * @covers \Misd\Collections\HashMap::putAll
     */
    public function testPutAllChaining()
    {
        $map = new HashMap();

        $this->assertInstanceOf(
            'Misd\Collections\MapInterface',
            $map->putAll(array('key' => 'value')),
            '->putAll() returns a reference to the map'
        );
    }

    /**
     * @covers \Misd\Collections\HashMap::remove
     */
    public function testRemove()
    {
        $map = new HashMap(array('key' => 'value'));

        $map->remove('key');

        $this->assertNull($map->get('key'));
    }

    /**
     * @covers \Misd\Collections\HashMap::remove
     */
    public function testRemoveChaining()
    {
        $map = new HashMap(array('key' => 'value'));

        $this->assertInstanceOf(
            'Misd\Collections\MapInterface',
            $map->remove('key'),
            '->remove() returns a reference to the map'
        );
    }

    /**
     * @covers \Misd\Collections\HashMap::removeAll
     */
    public function testRemoveAllWithArray()
    {
        $map = new HashMap(array('key' => 'value'));

        $map->removeAll(array('key'));

        $this->assertNull($map->get('key'));
    }

    /**
     * @covers \Misd\Collections\HashMap::removeAll
     */
    public function testRemoveAllChaining()
    {
        $map = new HashMap(array('key' => 'value'));

        $this->assertInstanceOf(
            'Misd\Collections\MapInterface',
            $map->removeAll(array('key')),
            '->removeAll() returns a reference to the map'
        );
    }

    /**
     * @covers \Misd\Collections\HashMap::clear
     */
    public function testClear()
    {
        $map = new HashMap(array('key' => 'value'));

        $map->clear();

        $this->assertEquals(0, $map->count());
    }

    /**
     * @covers \Misd\Collections\HashMap::clear
     */
    public function testClearChaining()
    {
        $map = new HashMap(array('key' => 'value'));

        $this->assertInstanceOf(
            'Misd\Collections\MapInterface',
            $map->clear(),
            '->clear() returns a reference to the map'
        );
    }
}
