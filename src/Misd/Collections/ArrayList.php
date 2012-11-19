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
     * @var SubArrayList[]
     */
    protected $subLists = array();

    /**
     * Adds the element to the end of the list.
     *
     * @param mixed $element Element to add to the list.
     *
     * @return ArrayList A reference to the list.
     *
     * @see addAll
     */
    public function add($element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * Adds elements to the end of the list.
     *
     * @param CollectionInterface|array $elements Elements to add to the list.
     *
     * @return ArrayList A reference to the list.
     *
     * @see add
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
     * Inserts the element at the specified position in this list.
     *
     * Shifts the element currently at that position (if any) and any subsequent
     * elements to the right (adds one to their indices).
     *
     * @param int   $index   Index to insert at.
     * @param mixed $element Element to insert.
     *
     * @return ArrayList A reference to the list.
     *
     * @throws OutOfBoundsException If the index is out of range.
     *
     * @see insertAll, add
     */
    public function insert($index, $element)
    {
        if (0 < $index && $this->count() < $index) {
            throw new OutOfBoundsException();
        }

        array_splice($this->elements, $index, 0, $element);

        foreach ($this->subLists as $subList) {
            $subList->insert($index, $element, true);
        }

        return $this;
    }

    /**
     * Inserts all of the elements into this list at the specified position.
     *
     * Shifts the element currently at that position (if any) and any
     * subsequent elements to the right (increases their indices). The new
     * elements will appear in this list in the order that they are returned by
     * the specified collection's iterator.
     *
     * @param int                       $index    Index at insert at.
     * @param CollectionInterface|array $elements Elements to insert.
     *
     * @return ArrayList A reference to the list.
     *
     * @throws OutOfBoundsException If the index is out of range.
     *
     * @see insert, addAll
     */
    public function insertAll($index, $elements)
    {
        if (0 < $index && $this->count() < $index) {
            throw new OutOfBoundsException();
        }

        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        } else {
            $elements = array_values($elements);
        }

        array_splice($this->elements, $index, 0, $elements);

        foreach ($this->subLists as $subList) {
            $subList->insertAll($index, $elements, true);
        }

        return $this;
    }

    /**
     * Replaces the element at the specified position in this list with the
     * specified element.
     *
     * @param int   $index   Index of the element to replace.
     * @param mixed $element Element to replace.
     *
     * @return ArrayList A reference to the list.
     *
     * @throws OutOfBoundsException If the index is out of range.
     */
    public function set($index, $element)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        $this->elements[$index] = $element;

        foreach ($this->subLists as $subList) {
            $subList->set($index, $element, true);
        }

        return $this;
    }

    /**
     * Removes the first instance of the element from the list, if it is present.
     *
     * @param mixed $element Element to be removed from the list.
     *
     * @return ArrayList A reference to the list.
     *
     * @see removeAll
     */
    public function remove($element)
    {
        $key = array_search($element, $this->elements, true);

        if (false !== $key) {
            unset($this->elements[$key]);
            $this->elements = array_values($this->elements);
        }

        foreach ($this->subLists as $subList) {
            $subList->drop($key, true);
        }

        return $this;
    }

    /**
     * Removes all instances of the elements from the list, if they are present.
     *
     * @param CollectionInterface|array $elements Elements to be removed from the list, if present.
     *
     * @return ArrayList A reference to the list.
     *
     * @see remove
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

        foreach ($this->subLists as $subList) {
            $subList->removeAll($elements, true);
        }

        return $this;
    }

    /**
     * Removes the element at the specified position in this list.
     *
     * Shifts any subsequent elements to the left (subtracts one from their
     * indices).
     *
     * @param int $index Index of the element to be removed.
     *
     * @return ArrayList A reference to the list.
     *
     * @throws OutOfBoundsException If the index is out of range.
     */
    public function drop($index)
    {
        if (false === array_key_exists($index, $this->elements)) {
            throw new OutOfBoundsException();
        }

        unset($this->elements[$index]);
        $this->elements = array_values($this->elements);

        foreach ($this->subLists as $subList) {
            $subList->drop($index, true);
        }

        return $this;
    }

    /**
     * Removes all elements from the list.
     *
     * @return ArrayList A reference to the list.
     */
    public function clear()
    {
        $this->elements = array();

        foreach ($this->subLists as $subList) {
            $subList->clear(true);
        }

        return $this;
    }

    /**
     * Retains only the elements in the list that are contained in the specified
     * collection.
     *
     * In other words, removes from the list all of its elements that are not
     * contained in the specified collection.
     *
     * @param CollectionInterface|array $elements Elements to be retained in the list.
     *
     * @return ArrayList A reference to the list.
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

    /**
     * Returns a view of the portion of this list between the specified
     * `fromIndex`, inclusive, and `toIndex`, exclusive. (If `fromIndex` and
     * `toIndex` are equal, the returned list is empty.)
     *
     * The returned list is backed by this list, so changes in the returned
     * list are reflected in this list, and vice-versa. The returned list
     * supports all of the optional list operations supported by this list.
     *
     * @param int $fromIndex Low endpoint (inclusive) of the sub-list.
     * @param int $toIndex   High endpoint (exclusive) of the sub-list.
     *
     * @return ArrayList A view of the specified range within this list.
     *
     * @throws OutOfBoundsException If one of the indices is out of range.
     */
    public function subList($fromIndex, $toIndex)
    {
        if ($fromIndex > $toIndex || $fromIndex < 0 || $toIndex > $this->count()) {
            throw new OutOfBoundsException();
        }

        $subList = SubArrayList::factory($this, $fromIndex, $toIndex);
        $this->subLists[] = $subList;

        return $subList;
    }
}

/**
 * Array list that is a section of a parent array list. Do not create this
 * object anywhere other than in `ArrayList::subList()`.
 *
 * @ignore
 * @internal
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
final class SubArrayList extends ArrayList
{
    /**
     * @var ArrayList
     */
    private $parent;
    private $fromIndex;

    public static function factory(ArrayList $parent, $fromIndex, $toIndex)
    {
        $subList = new self(array_values(
            array_slice($parent->toArray(), $fromIndex, $toIndex - $fromIndex, true)
        ));
        $subList->parent = $parent;
        $subList->fromIndex = $fromIndex;

        return $subList;
    }

    public function add($element)
    {
        $this->parent->insert($this->fromIndex + $this->count(), $element);

        return $this;
    }

    public function addAll($elements)
    {
        $this->parent->insertAll($this->fromIndex + $this->count(), $elements);

        return $this;
    }

    public function insert($index, $element, $fromParent = false)
    {
        if (true === $fromParent) {
            $thisIndex = $index - $this->fromIndex;
            if (0 <= $thisIndex && $this->count() >= $thisIndex) {
                parent::insert($thisIndex, $element);
            }
        } else {
            $this->parent->insert($this->fromIndex + $index, $element);
        }

        return $this;
    }

    public function insertAll($index, $elements, $fromParent = false)
    {
        if (true === $fromParent) {
            $thisIndex = $index - $this->fromIndex;
            if (0 <= $thisIndex && $this->count() >= $thisIndex) {
                parent::insertAll($thisIndex, $elements);
            }
        } else {
            $this->parent->insertAll($this->fromIndex + $index, $elements);
        }

        return $this;
    }

    public function set($index, $element, $fromParent = false)
    {
        if (true === $fromParent) {
            $thisIndex = $index - $this->fromIndex;
            if (0 <= $thisIndex && $this->count() > $thisIndex) {
                parent::set($thisIndex, $element);
            }
        } else {
            $this->parent->set($index + $this->fromIndex, $element);
        }

        return $this;
    }

    public function get($index)
    {
        if (0 > $index && $this->count() > $index) {
            throw new OutOfBoundsException($index);
        }

        return $this->parent->get($index + $this->fromIndex);
    }

    public function remove($element)
    {
        $key = array_search($element, $this->toArray(), true);

        if (false !== $key) {
            $this->parent->drop($key + $this->fromIndex);
        }

        return $this;
    }

    public function removeAll($elements, $fromParent = false)
    {
        if (true === $fromParent) {
            parent::removeAll($elements);
        } else {
            $this->parent->removeAll($elements);
        }

        return $this;
    }

    public function drop($index, $fromParent = false)
    {
        if (true === $fromParent) {
            $thisIndex = $index - $this->fromIndex;
            if (0 <= $thisIndex && $this->count() > $thisIndex) {
                parent::drop($thisIndex);
            }
        } else {
            $this->parent->drop($index + $this->fromIndex);
        }

        return $this;
    }

    public function retainAll($elements)
    {
        // TODO
    }

    public function clear($fromParent = false)
    {
        if (true === $fromParent) {
            parent::clear();
        } else {
            $loops = $this->count();
            for ($i = 0; $i < $loops; $i++) {
                $this->parent->drop($this->fromIndex);
            }
        }

        return $this;
    }
}
