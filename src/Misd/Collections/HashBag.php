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

/**
 * Hash-map-based implementation of {@link BagInterface}.
 *
 * It makes no guarantees as to the iteration order of the bag; in particular,
 * it does not guarantee that the order will remain constant over time.
 *
 * This class permits the null element.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class HashBag extends AbstractBag
{
    /**
     * @var HashMap
     */
    protected $elements;

    /**
     * {@inheritdoc}
     */
    public function __construct($elements = array())
    {
        $this->elements = new HashMap();
        $this->addAll($elements);
    }

    /**
     * Adds a copy of the element to the bag.
     *
     * @param mixed $element Element to add to the bag.
     *
     * @return HashBag A reference to the bag.
     *
     * @see allAll
     */
    public function add($element)
    {
        $this->elements->put($element, 1 + $this->elements->get($element));

        return $this;
    }

    /**
     * Adds copies of the element to the bag.
     *
     * @param mixed $element Element to add.
     * @param int   $copies  Number of copies to add.
     *
     * @return HashBag A reference to the bag.
     *
     * @see setCopies
     */
    public function addCopies($element, $copies)
    {
        $this->elements->put($element, $copies + $this->elements->get($element));

        return $this;
    }

    /**
     * Adds all of the elements to the bag.
     *
     * @param CollectionInterface|array $elements Elements to add to the bag.
     *
     * @return HashBag A reference to the bag.
     *
     * @see add
     */
    public function addAll($elements)
    {
        foreach ($elements as $element) {
            $this->add($element);
        }

        return $this;
    }

    /**
     * Set the number of occurrences (cardinality) of the element in the
     * bag. Setting it to 0 will remove the element from the bag.
     *
     * @param mixed $element Element to set.
     * @param int   $copies  Number of copies.
     *
     * @return HashBag A reference to the bag.
     *
     * @see addCopies
     */
    public function setCopies($element, $copies)
    {
        if (0 === $copies) {
            $this->elements->remove($element);
        } else {
            $this->elements->put($element, $copies);
        }

        return $this;
    }

    /**
     * Returns the number of occurrences (cardinality) of the element in the
     * bag. If the element does not exist in the bag, return 0.
     *
     * @param mixed $element Element to search for.
     *
     * @return int Number of occurrences of the object, 0 if not found.
     */
    public function getCopies($element)
    {
        return $this->elements->get($element) ? : 0;
    }

    /**
     * Returns `true` if the bag contains at least one copy of the specified
     * element.
     *
     * @param mixed $element Element to test.
     *
     * @return bool `true` if the bag contains the specified element, otherwise `false`.
     *
     * @see containsAll
     */
    public function contains($element)
    {
        return null !== $this->elements->get($element);
    }

    /**
     * Returns `true` if the bag contains at least one copy of all of the
     * specified elements.
     *
     * @param CollectionInterface|array $elements Elements to test.
     *
     * @return bool `true` if the bag contains all of the specified elements, otherwise `false`.
     *
     * @see contains
     */
    public function containsAll($elements)
    {
        return $this->elements->containsKeys($elements);
    }

    /**
     * Removes a single copy of the element from the bag, if it is present.
     *
     * @param mixed $element Element to be removed from the bag.
     *
     * @return HashBag A reference to the bag.
     *
     * @see removeAll
     */
    public function remove($element)
    {
        return $this->removeCopies($element, 1);
    }

    /**
     * Removes occurrences of the given element from the bag.
     *
     * @param mixed $element Element to remove.
     * @param int   $copies  Number of copies to remove.
     *
     * @return HashBag A reference to the bag.
     */
    public function removeCopies($element, $copies)
    {
        $oldCopies = $this->elements->get($element);

        if ($copies < $oldCopies) {
            $this->elements->put($element, $oldCopies - $copies);
        } else {
            $this->elements->remove($element);
        }

        return $this;
    }

    /**
     * Removes all occurrences of the given element from the bag.
     *
     * @param mixed $element Element to remove.
     *
     * @return HashBag A reference to the bag.
     */
    public function removeAllCopies($element)
    {
        $this->elements->remove($element);

        return $this;
    }

    /**
     * Removes all occurrences of the elements from the bag, if they are present.
     *
     * @param CollectionInterface|array $elements Elements to be removed from the bag, if present.
     *
     * @return HashBag A reference to the bag.
     *
     * @see remove
     */
    public function removeAll($elements)
    {
        $this->elements->removeAll($elements);

        return $this;
    }

    /**
     * Retains only the elements in the bag that are contained in the specified
     * collection.
     *
     * In other words, removes from the bag all of its elements that are not
     * contained in the specified collection.
     *
     * @param CollectionInterface|array $elements Elements to be retained in the bag.
     *
     * @return HashBag A reference to the bag.
     *
     * @see remove, removeAll
     */
    public function retainAll($elements)
    {
        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        }

        foreach ($this->elements->keySet() as $element) {
            if (false === in_array($element, $elements)) {
                $this->elements->remove($element);
            }
        }

        return $this;
    }

    /**
     * Removes all elements from the bag.
     *
     * @return HashBag A reference to the bag.
     */
    public function clear()
    {
        $this->elements->clear();

        return $this;
    }

    /**
     * Returns the total number of items in the bag.
     *
     * @return int Total number of items in the bag.
     */
    public function count()
    {
        return array_sum($this->elements->values()->toArray());
    }

    /**
     * Returns `true` if the bag contains no elements.
     *
     * @return bool `true` if the bag contains no elements, otherwise `false`.
     */
    public function isEmpty()
    {
        return $this->elements->isEmpty();
    }

    /**
     * Returns an array containing all of the elements in the bag.
     *
     * @return array An array containing all of the elements in the bag.
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->elements->keySet() as $element) {
            for ($i = 1; $i <= $this->elements->get($element); $i++) {
                $array[] = $element;
            }
        }

        return $array;
    }
}
