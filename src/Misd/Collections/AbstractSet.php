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
 * Abstract set.
 *
 * This provides a skeletal implementation of {@link SetInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable collection: you must overwrite methods such as `add()`
 * to allow modification.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractSet extends AbstractCollection implements SetInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct($elements = array())
    {
        if ($elements instanceof CollectionInterface) {
            $elements = $elements->toArray();
        }

        $this->elements = array_values(array_unique($elements, SORT_REGULAR));
    }
}
