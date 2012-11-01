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
 * Tree-map-based implementation of {@link SortedSetInterface}. The elements
 * are ordered using their natural ordering, or by a Comparator provided at set
 * creation time, depending on which constructor is used.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class TreeSet extends HashSet implements SortedSetInterface
{
    /**
     * @var TreeMap
     */
    protected $elements;

    /**
     * {@inheritdoc}
     */
    public function __construct($elements = array(), ComparatorInterface $comparator = null)
    {
        $this->elements = new TreeMap(array(), $comparator);
        $this->addAll($elements);
    }

    /**
     * {@inheritdoc}
     */
    public function comparator()
    {
        return $this->elements->comparator();
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException();
        }

        return $this->elements->firstKey();
    }

    /**
     * {@inheritdoc}
     */
    public function last()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException();
        }

        return $this->elements->lastKey();
    }
}
