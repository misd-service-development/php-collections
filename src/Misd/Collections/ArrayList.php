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

/**
 * Resizable-array implementation of {@link ListInterface}.
 *
 * Implements all optional list operations, and permits all elements, including
 * `null`.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class ArrayList extends AbstractList
{
    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function add($element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function addAll($elements)
    {
        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        } else {
            $elements = array_values($elements);
        }

        $this->elements = array_merge($this->elements, $elements);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function insert($index, $element)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        array_splice($this->elements, $index, 0, $element);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function insertAll($index, $elements)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        } else {
            $elements = array_values($elements);
        }

        array_splice($this->elements, $index, 0, $elements);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function set($index, $element)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        $this->elements[$index] = $element;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function remove($element)
    {
        $key = array_search($element, $this->elements, true);

        if (false !== $key) {
            unset($this->elements[$key]);
            $this->elements = array_values($this->elements);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function removeAll($elements)
    {
        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        }

        $this->elements = array_values(
            array_udiff(
                $this->elements,
                $elements,
                function ($a, $b) {
                    if ($a === $b) {
                        return 0;
                    } elseif (is_int($a) && is_object($b)) {
                        return -1;
                    } elseif (is_object($a) && is_int($b)) {
                        return 1;
                    } elseif ($a < $b) {
                        return -1;
                    } else {
                        return 1;
                    }
                }
            )
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function drop($index)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        unset($this->elements[$index]);
        $this->elements = array_values($this->elements);

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function clear()
    {
        $this->elements = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function retainAll($elements)
    {
        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        }

        $this->elements = array_values(
            array_uintersect(
                $this->elements,
                $elements,
                function ($a, $b) {
                    if ($a === $b) {
                        return 0;
                    } elseif (is_int($a) && is_object($b)) {
                        return -1;
                    } elseif (is_object($a) && is_int($b)) {
                        return 1;
                    } elseif ($a < $b) {
                        return -1;
                    } else {
                        return 1;
                    }
                }
            )
        );

        return $this;
    }
}
