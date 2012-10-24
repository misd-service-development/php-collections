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
 * Abstract bag.
 *
 * This provides a skeletal implementation of {@link BagInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable collection: you must overwrite methods such as `add()`
 * to allow modification.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractBag extends AbstractCollection implements BagInterface
{
    /**
     * {@inheritdoc}
     */
    public function addCopies($element, $copies)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function setCopies($element, $copies)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function getCopies($element)
    {
        return count(array_keys($this->elements, $element, true));
    }

    /**
     * {@inheritdoc}
     */
    public function removeCopies($element, $copies)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function removeAllCopies($element)
    {
        throw new UnsupportedOperationException();
    }
}
