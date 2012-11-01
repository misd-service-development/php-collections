<?php

/*
 * This file is part of the Collections library.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\Collections\Comparison;

use UnexpectedValueException;

/**
 * Comparator.
 *
 * A comparison function, which imposes a total ordering on some collection of objects.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface ComparatorInterface
{
    /**
     * Compares its two arguments for order.
     *
     * Returns a negative integer, zero, or a positive integer as the first
     * argument is less than, equal to, or greater than the second.
     *
     * @param mixed $item1 First item to be compared.
     * @param mixed $item2 Second item to be compared.
     *
     * @return int A negative integer, zero, or a positive integer as the first argument is less than, equal to, or
     *             greater than the second.
     *
     * @throws UnexpectedValueException If the arguments' types prevent them from being compared by this comparator.
     */
    public function compare($item1, $item2);
}
