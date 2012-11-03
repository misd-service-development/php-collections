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
 * A set that further provides a total ordering on its elements.
 *
 * The elements are ordered using their natural ordering, or by a comparator
 * typically provided at sorted set creation time.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface SortedSetInterface extends SetInterface
{
    /**
     * Constructor.
     *
     * @param CollectionInterface|array $elements   Optional initial elements.
     * @param ComparatorInterface|null  $comparator Optional comparator.
     */
    public function __construct($elements = array(), ComparatorInterface $comparator = null);

    /**
     * Returns the comparator used to order the elements in this set, or null
     * if this set uses the natural ordering of its elements.
     *
     * @return ComparatorInterface|null The comparator used to order the elements in this set, or null if this set uses
     *                                  the natural ordering of its elements
     */
    public function comparator();

    /**
     * Returns the first (lowest) element currently in this set.
     *
     * @return mixed The first (lowest) element currently in this set.
     *
     * @throws UnderflowException If this set is empty.
     */
    public function first();

    /**
     * Returns the last (highest) element currently in this set.
     *
     * @return mixed The last (highest) element currently in this set.
     *
     * @throws UnderflowException If this set is empty.
     */
    public function last();
}
