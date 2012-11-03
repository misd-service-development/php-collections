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

use OutOfBoundsException;
use Misd\Collections\Exception\UnsupportedOperationException;

/**
 * This provides a skeletal implementation of {@link ListInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable collection: you must overwrite methods such as `add()`
 * to allow modification.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractList extends AbstractCollection implements ListInterface
{
    /**
     * {@inheritdoc}
     */
    public function insert($index, $element)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function insertAll($index, $elements)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function set($index, $element)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function get($index)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        return $this->elements[$index];
    }

    /**
     * {@inheritdoc}
     */
    public function drop($index)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function indexOf($element)
    {
        $key = array_search($element, $this->elements, true);

        return false === $key ? null : $key;
    }

    /**
     * {@inheritdoc}
     */
    public function lastIndexOf($element)
    {
        $key = array_search($element, array_reverse($this->elements, true), true);

        return false === $key ? null : $key;
    }
}
