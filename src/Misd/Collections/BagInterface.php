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
 * Bag.
 *
 * A set in which elements are allowed to appear more than once (also known as
 * a multiset).
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface BagInterface extends CollectionInterface
{
    /**
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
     */
    public function add($element);

    /**
     * Adds copies of the element to the bag.
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
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
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
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
     */
    public function remove($element);

    /**
     * Removes occurrences of the given element from the bag.
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
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
     */
    public function removeAll($elements);

    /**
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
     */
    public function clear();

    /**
     * {@inheritdoc}
     *
     * @return BagInterface A reference to the bag.
     */
    public function retainAll($elements);
}
