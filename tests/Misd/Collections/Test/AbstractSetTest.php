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
use Misd\Collections\ArrayList,
    Misd\Collections\HashSet;

/**
 * Abstract set test.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class AbstractSetTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \Misd\Collections\AbstractSet::__construct
     */
    public function testConstructorWithArray()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'two';

        $set = $this->getMockForAbstractClass(
            'Misd\Collections\AbstractSet',
            array(array('one', 'two', 'two', $object1, $object2, $object2))
        );
        $this->assertEquals(array('one', 'two', $object1, $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractSet::__construct
     */
    public function testConstructorWithSet()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'two';

        $set2 = new HashSet(array('one', 'two', $object1, $object2));
        $set = $this->getMockForAbstractClass('Misd\Collections\AbstractSet', array($set2));

        $this->assertEquals(array('one', 'two', $object1, $object2), $set->toArray());
    }

    /**
     * @covers \Misd\Collections\AbstractSet::__construct
     */
    public function testConstructorWithCollection()
    {
        $object1 = new TestObject();
        $object1->firstValue = 'one';
        $object2 = new TestObject();
        $object2->secondValue = 'two';

        $collection = new ArrayList(array('one', 'two', 'two', $object1, $object2, $object2));
        $set = $this->getMockForAbstractClass('Misd\Collections\AbstractSet', array($collection));

        $this->assertEquals(array('one', 'two', $object1, $object2), $set->toArray());
    }
}
