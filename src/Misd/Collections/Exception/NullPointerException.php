<?php

/*
 * This file is part of the Collections library.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\Collections\Exception;

use RuntimeException;

/**
 * Thrown when an application attempts to use null in a case where a non-null
 * value is required.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class NullPointerException extends RuntimeException
{
}
