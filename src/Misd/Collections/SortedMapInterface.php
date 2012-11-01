<?php

/*
 * This file is part of the Collections library.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\Collections;

use UnderflowException;
use Misd\Collections\Comparison\ComparatorInterface;

/**
 * A map that further provides a total ordering on its keys. The map is ordered
 * according to the natural ordering of its keys, or by a comparator typically
 * provided at sorted map creation time.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface SortedMapInterface extends MapInterface
{
    /**
     * Constructor.
     *
     * @param MapInterface|array       $map        Optional initial map.
     * @param ComparatorInterface|null $comparator Optional comparator.
     */
    public function __construct($map = array(), ComparatorInterface $comparator = null);

    /**
     * Returns the comparator used to order the keys in this map, or null if
     * this map uses the natural ordering of its keys.
     *
     * @return ComparatorInterface|null The comparator used to order the keys in this map, or null if this map uses the
     *                                  natural ordering of its keys.
     */
    public function comparator();

    /**
     * Returns the first (lowest) key currently in this map.
     *
     * @return mixed The first (lowest) key currently in this map.
     *
     * @throws UnderflowException If this map is empty.
     */
    public function firstKey();

    /**
     * Returns the last (highest) key currently in this map.
     *
     * @return mixed The last (highest) key currently in this map.
     *
     * @throws UnderflowException If this map is empty.
     */
    public function lastKey();
}
