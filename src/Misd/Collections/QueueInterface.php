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

use UnderflowException,
    UnexpectedValueException;
use Misd\Collections\Exception\NullPointerException,
    Misd\Collections\Exception\UnsupportedOperationException;

/**
 * A collection designed for holding elements prior to processing.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface QueueInterface extends CollectionInterface
{
    /**
     * Adds the element to the queue.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to add to the queue.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws NullPointerException          If the element is null and the queue does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the queue (optional).
     * @throws UnsupportedOperationException If the `add` operation is not supported by the queue.
     *
     * @see allAll
     */
    public function add($element);

    /**
     * Adds elements to the queue.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to add to the queue.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws NullPointerException          If one or more of the elements is null and the queue does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the queue (optional).
     * @throws UnsupportedOperationException If the `addAll` operation is not supported by the queue.
     *
     * @see add
     */
    public function addAll($elements);

    /**
     * Retrieves, but does not remove, the head of this queue.
     *
     * @throws UnderflowException If this queue is empty.
     *
     * @return mixed The head of this queue.
     */
    public function peek();

    /**
     * Retrieves and removes the head of this queue.
     *
     * @throws UnderflowException If this queue is empty.
     *
     * @return mixed The head of this queue.
     */
    public function poll();

    /**
     * Returns `true` if the queue contains the specified element.
     *
     * @param mixed $element Element to test.
     *
     * @return bool `true` if the queue contains the specified element, otherwise `false`.
     *
     * @see containsAll
     */
    public function contains($element);

    /**
     * Returns `true` if the queue contains all of the specified elements.
     *
     * @param CollectionInterface|array $elements Elements to test.
     *
     * @return bool `true` if the queue contains all of the specified elements, otherwise `false`.
     *
     * @see contains
     */
    public function containsAll($elements);

    /**
     * Removes the element from the queue, if it is present.
     *
     * This is an optional operation.
     *
     * @param mixed $element Element to be removed from the queue, if present.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws NullPointerException          If the element is null and the queue does not permit null elements (optional).
     * @throws UnexpectedValueException      If the element is incompatible with the queue (optional).
     * @throws UnsupportedOperationException If the `remove` operation is not supported by the queue.
     *
     * @see removeAll
     */
    public function remove($element);

    /**
     * Removes elements from the queue, if they are present.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be removed from the queue, if present.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws NullPointerException          If one or more of the elements is null and the queue does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the queue (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the queue.
     *
     * @see remove
     */
    public function removeAll($elements);

    /**
     * Retains only the elements in the queue that are contained in the specified
     * collection. In other words, removes from the queue all of its elements
     * that are not contained in the specified collection.
     *
     * This is an optional operation.
     *
     * @param CollectionInterface|array $elements Elements to be retained in the queue.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws NullPointerException          If one or more of the elements is null and the queue does not permit null
     *                                       elements (optional).
     * @throws UnexpectedValueException      If one or more of the elements is incompatible with the queue (optional).
     * @throws UnsupportedOperationException If the `retainAll` operation is not supported by the queue.
     *
     * @see remove, removeAll
     */
    public function retainAll($elements);

    /**
     * Removes all elements from the queue.
     *
     * This is an optional operation.
     *
     * @return QueueInterface A reference to the queue.
     *
     * @throws UnsupportedOperationException If the `clear` operation is not supported by the queue.
     */
    public function clear();

    /**
     * Returns the number of elements in the queue.
     *
     * @return int Number of elements in the queue.
     */
    public function count();

    /**
     * Returns `true` if the queue contains no elements.
     *
     * @return bool `true` if the queue contains no elements, otherwise `false`.
     */
    public function isEmpty();

    /**
     * Returns an array containing all of the elements in the queue.
     *
     * @return array An array containing all of the elements in the queue.
     */
    public function toArray();
}
