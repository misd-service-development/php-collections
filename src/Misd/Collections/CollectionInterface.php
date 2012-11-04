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

use Countable, ArrayAccess, IteratorAggregate;
use UnexpectedValueException;
use Misd\Collections\Exception\NullPointerException,
    Misd\Collections\Exception\UnsupportedOperationException;

/**
 * A collection represents a group of objects, known as its elements.
 *
 * This is the root interface in the collection hierarchy. Some collections
 * allow duplicate elements and others do not. Some are ordered and others
 * unordered. The library does not provide any direct implementations of this
 * interface: it provides implementations of more specific sub-interfaces like
 * `SetInterface` and `ListInterface`. This interface is typically used to pass
 * collections around and manipulate them where maximum generality is desired.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface CollectionInterface extends Countable, ArrayAccess, IteratorAggregate
{
    /**
     * Constructor.
     *
     * @param CollectionInterface|array $elements Optional initial elements.
     */
    public function __construct($elements = array());

    /**
     * Adds a single instance of an element to the collection.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to add to the collection.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws NullPointerException          If the element is null and the collection does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this collection (optional).
     * @throws UnsupportedOperationException If the `add` operation is not supported by this collection.
     *
     * @see allAll
     */
    public function add($element);

    /**
     * Adds elements to the collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to add to the collection.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws NullPointerException          If one or more of the elements is null and this collection does not permit
     *                                       null elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the collection
     *                                       (optional).
     * @throws UnsupportedOperationException If the `addAll` operation is not supported by this collection.
     *
     * @see add
     */
    public function addAll($elements);

    /**
     * Returns `true` if the collection contains a specified element.
     *
     * @param mixed $element Element to test.
     *
     * @return bool `true` if this collection contains the specified element, otherwise `false`.
     *
     * @see containsAll
     */
    public function contains($element);

    /**
     * Returns `true` if this collection contains all of the specified elements.
     *
     * @param CollectionInterface|array $elements Elements to test.
     *
     * @return bool `true` if this collection contains all of the specified elements, otherwise `false`.
     *
     * @see contains
     */
    public function containsAll($elements);

    /**
     * Removes a single instance of an element from this collection, if it is
     * present.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to be removed from this collection.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws NullPointerException          If the element is null and this collection does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this collection (optional).
     * @throws UnsupportedOperationException If the `remove` operation is not supported by this collection.
     *
     * @see removeAll
     */
    public function remove($element);

    /**
     * Removes all instances of elements from the collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be removed from this collection, if present.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws NullPointerException          If one or more of the elements is null and this collection does not permit
     *                                       null elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the collection
     *                                       (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by this collection.
     *
     * @see remove
     */
    public function removeAll($elements);

    /**
     * Retains only the elements in this collection that are contained in the
     * specified collection.
     *
     * In other words, removes from this collection all of its elements that
     * are not contained in the specified collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be retained in this collection.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws NullPointerException          If one or more of the elements is null and this collection does not permit
     *                                       null elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the collection
     *                                       (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by this collection.
     *
     * @see remove, removeAll
     */
    public function retainAll($elements);

    /**
     * Removes all elements from this collection.
     *
     * This is an optional operation.
     *
     * @return CollectionInterface A reference to the collection.
     *
     * @throws UnsupportedOperationException If the `clear` operation is not supported by this collection.
     */
    public function clear();

    /**
     * Returns the number of elements in the collection.
     *
     * @return int Number of elements in the collection.
     */
    public function count();

    /**
     * Returns `true` if this collection contains no elements.
     *
     * @return bool `true` if this collection contains no elements, otherwise `false`.
     */
    public function isEmpty();

    /**
     * Returns an array containing all of the elements in this collection.
     *
     * @return array An array containing all of the elements in this collection.
     */
    public function toArray();
}
