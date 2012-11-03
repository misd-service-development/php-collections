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

use Misd\Collections\Exception\UnsupportedOperationException;

/**
 * This provides a skeletal implementation of {@link CollectionInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable collection: you must overwrite methods such as `add()`
 * to allow modification.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractCollection implements CollectionInterface
{
    /**
     * Elements in the collection.
     *
     * @var array
     */
    protected $elements;

    /**
     * {@inheritdoc}
     */
    public function __construct($elements = array())
    {
        if ($elements instanceof CollectionInterface) {
            $this->elements = $elements->toArray();
        } else {
            $this->elements = array_values($elements);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function add($element)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function addAll($elements)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function contains($element)
    {
        return in_array($element, $this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function containsAll($elements)
    {
        foreach ($elements as $element) {
            if (false === in_array($element, $this->elements)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($element)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll($elements)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function retainAll($elements)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return 0 === $this->count();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->elements[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }
}
