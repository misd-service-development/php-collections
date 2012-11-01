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

use Misd\Collections\Comparison\ComparatorInterface;

/**
 * Sorted set.
 *
 * A Set that further provides a total ordering on its elements. The elements
 * are ordered using their natural ordering, or by a Comparator typically
 * provided at sorted set creation time.
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
}
