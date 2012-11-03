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
use Misd\Collections\TreeMap;

/**
 * Tree map test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class TreeMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\TreeMap::__construct
     * @covers \Misd\Collections\TreeMap::comparator
     */
    public function testConstructor()
    {
        $map = new TreeMap(array('one' => 'one', 'two' => 'two'));
        $this->assertEquals(array(0 => 'one', 1 => 'two'), $map->values()->toArray());
        $this->assertNull($map->comparator());
    }

    /**
     * @covers \Misd\Collections\TreeMap::firstKey
     */
    public function testFirstKey()
    {
        $map = new TreeMap(array('one' => 'one', 'first' => 'first', 'two' => 'two'));
        $this->assertEquals('first', $map->firstKey());
    }

    /**
     * @covers \Misd\Collections\TreeMap::firstKey
     * @expectedException \UnderflowException
     */
    public function testFirstKeyUnderflowException()
    {
        $map = new TreeMap();
        $map->firstKey();
    }

    /**
     * @covers \Misd\Collections\TreeMap::lastKey
     */
    public function testLastKey()
    {
        $map = new TreeMap(array('alpha' => 'alpha', 'last' => 'last', 1 => 1));
        $this->assertEquals('last', $map->lastKey());
    }

    /**
     * @covers \Misd\Collections\TreeMap::lastKey
     * @expectedException \UnderflowException
     */
    public function testLastKeyUnderflowException()
    {
        $map = new TreeMap();
        $map->lastKey();
    }
}
