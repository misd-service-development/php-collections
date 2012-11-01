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

use UnexpectedValueException;
use Misd\Collections\Exception\NullPointerException,
    Misd\Collections\Exception\UnsupportedOperationException;

/**
 * A collection that contains no duplicate elements.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface SetInterface extends CollectionInterface
{
    /**
     * Adds the element to the set, if not already present.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to add to the set.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws NullPointerException          If the element is null and the set does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the set (optional).
     * @throws UnsupportedOperationException If the `add` operation is not supported by the set.
     *
     * @see allAll
     */
    public function add($element);

    /**
     * Adds elements to the set, if not already present.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to add to the set.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws NullPointerException          If one or more of the elements is null and the set does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the set (optional).
     * @throws UnsupportedOperationException If the `addAll` operation is not supported by the set.
     *
     * @see add
     */
    public function addAll($elements);

    /**
     * Returns `true` if the set contains the specified element.
     *
     * @param mixed $element Element to test.
     *
     * @return bool `true` if the set contains the specified element, otherwise `false`.
     *
     * @see containsAll
     */
    public function contains($element);

    /**
     * Returns `true` if the set contains all of the specified elements.
     *
     * @param CollectionInterface|array $elements Elements to test.
     *
     * @return bool `true` if the set contains all of the specified elements, otherwise `false`.
     *
     * @see contains
     */
    public function containsAll($elements);

    /**
     * Removes the element from the set, if it is present.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to be removed from the set.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws NullPointerException          If the element is null and the set does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the set (optional).
     * @throws UnsupportedOperationException If the `remove` operation is not supported by the set.
     *
     * @see removeAll
     */
    public function remove($element);

    /**
     * Removes elements from the set, if they are present.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be removed from the set, if present.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws NullPointerException          If one or more of the elements is null and the set does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the set (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the set.
     *
     * @see remove
     */
    public function removeAll($elements);

    /**
     * Retains only the elements in the set that are contained in the specified
     * collection. In other words, removes from the set all of its elements
     * that are not contained in the specified collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be retained in the set.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws NullPointerException          If one or more of the elements is null and the set does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the set (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the set.
     *
     * @see remove, removeAll
     */
    public function retainAll($elements);

    /**
     * Removes all elements from the set.
     *
     * This is an optional operation.
     *
     * @return SetInterface A reference to the set.
     *
     * @throws UnsupportedOperationException If the `clear` operation is not supported by the set.
     */
    public function clear();

    /**
     * Returns the number of elements in the set.
     *
     * @return int Number of elements in the set.
     */
    public function count();

    /**
     * Returns `true` if the set contains no elements.
     *
     * @return bool `true` if the set contains no elements, otherwise `false`.
     */
    public function isEmpty();

    /**
     * Returns an array containing all of the elements in the set.
     *
     * @return array An array containing all of the elements in the set.
     */
    public function toArray();
}
