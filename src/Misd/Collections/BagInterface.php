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
 * A set in which elements are allowed to appear more than once (also known as
 * a multiset).
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface BagInterface extends CollectionInterface
{
    /**
     * Adds a copy of the element to the bag.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to add to the bag.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and the bag does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the bag (optional).
     * @throws UnsupportedOperationException If the `add` operation is not supported by the bag.
     *
     * @see allAll
     */
    public function add($element);

    /**
     * Adds copies of the element to the bag.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to add.
     * @param int   $copies  Number of copies to add.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and this bag does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this bag (optional).
     * @throws UnsupportedOperationException If the `addCopies` operation is not supported by this bag.
     *
     * @see setCopies
     */
    public function addCopies($element, $copies);

    /**
     * Adds all of the elements to the bag.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to add to the bag.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If one or more of the elements is null and the bag does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the bag (optional).
     * @throws UnsupportedOperationException If the `addAll` operation is not supported by the bag.
     *
     * @see add
     */
    public function addAll($elements);

    /**
     * Set the number of occurrences (cardinality) of the element in the
     * bag. Setting it to 0 will remove the element from the bag.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to set.
     * @param int   $copies  Number of copies.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and this bag does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this bag (optional).
     * @throws UnsupportedOperationException If the `setCopies` operation is not supported by this bag.
     *
     * @see addCopies
     */
    public function setCopies($element, $copies);

    /**
     * Returns the number of occurrences (cardinality) of the element in the
     * bag. If the element does not exist in the bag, return 0.
     *
     * @param mixed $element Element to search for.
     *
     * @return int Number of occurrences of the object, 0 if not found.
     *
     * @throws NullPointerException     If the element is null and this bag does not permit null elements (optional).
     * @throws UnexpectedValueException If the element is incompatible with this bag (optional).
     */
    public function getCopies($element);

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
    public function contains($element);

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
    public function containsAll($elements);

    /**
     * Removes a single copy of the element from the bag, if it is present.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to be removed from the bag.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and the bag does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the bag (optional).
     * @throws UnsupportedOperationException If the `remove` operation is not supported by the bag.
     *
     * @see removeAll
     */
    public function remove($element);

    /**
     * Removes occurrences of the given element from the bag.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to remove.
     * @param int   $copies  Number of copies to remove.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and this bag does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this bag (optional).
     * @throws UnsupportedOperationException If the `removeCopies` operation is not supported by this bag.
     */
    public function removeCopies($element, $copies);

    /**
     * Removes all occurrences of the given element from the bag.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to remove.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If the element is null and this bag does not permit null elements
     *                                       (optional).
     * @throws UnexpectedValueException      If the element is incompatible with this bag (optional).
     * @throws UnsupportedOperationException If the `removeAllCopies` operation is not supported by this bag.
     */
    public function removeAllCopies($element);

    /**
     * Removes all occurrences of the elements from the bag, if they are present.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be removed from the bag, if present.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If one or more of the elements is null and the bag does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the bag (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the bag.
     *
     * @see remove
     */
    public function removeAll($elements);

    /**
     * Retains only the elements in the bag that are contained in the specified
     * collection.
     *
     * In other words, removes from the bag all of its elements that are not
     * contained in the specified collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be retained in the bag.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws NullPointerException          If one or more of the elements is null and the bag does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the bag (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the bag.
     *
     * @see remove, removeAll
     */
    public function retainAll($elements);

    /**
     * Removes all elements from the bag.
     *
     * This is an optional operation.
     *
     * @return BagInterface A reference to the bag.
     *
     * @throws UnsupportedOperationException If the `clear` operation is not supported by the bag.
     */
    public function clear();

    /**
     * Returns the total number of items in the bag.
     *
     * @return int Total number of items in the bag.
     */
    public function count();

    /**
     * Returns `true` if the bag contains no elements.
     *
     * @return bool `true` if the bag contains no elements, otherwise `false`.
     */
    public function isEmpty();

    /**
     * Returns an array containing all of the elements in the bag.
     *
     * @return array An array containing all of the elements in the bag.
     */
    public function toArray();
}
