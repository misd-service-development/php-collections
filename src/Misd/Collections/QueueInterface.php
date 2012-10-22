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

use UnderflowException;

/**
 * Queue.
 *
 * A collection designed for holding elements prior to processing.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface QueueInterface extends CollectionInterface
{
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
}
