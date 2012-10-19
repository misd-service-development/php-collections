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

use OutOfBoundsException,
    UnexpectedValueException;
use Misd\Collections\Exception\NullPointerException,
    Misd\Collections\Exception\UnsupportedOperationException;

/**
 * List.
 *
 * An ordered collection (also known as a sequence). The user of this interface
 * has precise control over where in the list each element is inserted. The
 * user can access elements by their integer index (position in the list), and
 * search for elements in the list.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface ListInterface extends CollectionInterface
{
    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function add($element);

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function addAll($elements);

    /**
     * Inserts the element at the specified position in this list. Shifts the
     * element currently at that position (if any) and any subsequent elements
     * to the right (adds one to their indices).
     *
     * This is an optional operation.
     *
     * @param int   $index   Index to insert at.
     * @param mixed $element Element to insert.
     *
     * @return ListInterface A reference to the list.
     *
     * @throws NullPointerException          If the element is null and this list does not permit null elements
     *                                       (optional).
     * @throws OutOfBoundsException          If the index is out of range.
     * @throws UnexpectedValueException      If the element is incompatible with this collection (optional).
     * @throws UnsupportedOperationException If the `insert` operation is not supported by this list.
     *
     * @see add
     */
    public function insert($index, $element);

    /**
     * Inserts all of the elements into this list at the specified position.
     * Shifts the element currently at that position (if any) and any
     * subsequent elements to the right (increases their indices). The new
     * elements will appear in this list in the order that they are returned by
     * the specified collection's iterator.
     *
     * This is an optional operation.
     *
     * @param int                       $index    Index at insert at.
     * @param CollectionInterface|array $elements Elements to insert.
     *
     * @return ListInterface A reference to the list.
     *
     * @throws NullPointerException          If the element is null and this list does not permit null elements
     *                                       (optional).
     * @throws OutOfBoundsException          If the index is out of range.
     * @throws UnexpectedValueException      If an element is incompatible with this collection (optional).
     * @throws UnsupportedOperationException If the `insertAll` operation is not supported by this list.
     */
    public function insertAll($index, $elements);

    /**
     * Replaces the element at the specified position in this list with the
     * specified element.
     *
     * This is an optional operation.
     *
     * @param int   $index   Index of the element to replace.
     * @param mixed $element Element to replace.
     *
     * @return ListInterface A reference to the list.
     *
     * @throws NullPointerException          If the element is null and this list does not permit null elements
     *                                       (optional).
     * @throws OutOfBoundsException          If the index is out of range.
     * @throws UnexpectedValueException      If the element is incompatible with this collection (optional).
     * @throws UnsupportedOperationException If the `set` operation is not supported by this list.
     */
    public function set($index, $element);

    /**
     * Returns the element at the specified position in this list.
     *
     * @param int $index Index of the element to return.
     *
     * @return mixed The element at the specified index in this list.
     *
     * @throws OutOfBoundsException If the index is out of range.
     */
    public function get($index);

    /**
     * Removes the element at the specified position in this list. Shifts any
     * subsequent elements to the left (subtracts one from their indices).
     *
     * This is an optional operation.
     *
     * @param int $index Index of the element to be removed.
     *
     * @return ListInterface A reference to the list.
     *
     * @throws OutOfBoundsException          If the index is out of range.
     * @throws UnsupportedOperationException If the `drop` operation is not supported by this list.
     */
    public function drop($index);

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function remove($element);

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function removeAll($elements);

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function retainAll($elements);

    /**
     * {@inheritdoc}
     *
     * @return ListInterface A reference to the list.
     */
    public function clear();

    /**
     * Returns the index of the first occurrence of the specified element in
     * this list, or null if this list does not contain the element.
     *
     * @param mixed $element Element to search for.
     *
     * @return int|null The index of the first occurrence of the specified element in this list, or null if this list
     *                  does not contain the element.
     *
     * @throws NullPointerException If the element is null and this list does not permit null elements (optional).
     */
    public function indexOf($element);

    /**
     * Returns the index of the last occurrence of the specified element in
     * this list, or null if this list does not contain the element.
     *
     * @param mixed $element Element to search for.
     *
     * @return int|null The index of the last occurrence of the specified element in this list, or null if this list
     *                  does not contain the element.
     *
     * @throws NullPointerException If the element is null and this list does not permit null elements (optional).
     */
    public function lastIndexOf($element);
}
