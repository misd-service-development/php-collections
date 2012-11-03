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
use Misd\Collections\Comparison\ComparableInterface,
    Misd\Collections\Comparison\ComparatorInterface;

/**
 * Hash-map-based implementation of {@link SortedMapInterface}
 *
 * The keys are ordered using their natural ordering, or by a Comparator
 * provided at map creation time.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class TreeMap extends HashMap implements SortedMapInterface
{
    /**
     * Comparator.
     *
     * @var ComparatorInterface|null
     */
    protected $comparator;

    /**
     * {@inheritdoc}
     */
    public function __construct($map = array(), ComparatorInterface $comparator = null)
    {
        parent::__construct();

        $this->putAll($map);
        $this->comparator = $comparator;
    }

    /**
     * {@inheritdoc}
     */
    public function comparator()
    {
        return $this->comparator;
    }

    /**
     * {@inheritdoc}
     *
     * @return SortedMapInterface A reference to the map.
     */
    public function put($key, $value)
    {
        parent::put($key, $value);

        if (null === $this->comparator) {
            $comparableKeys = array();
            $otherKeys = array();
            foreach ($this->keys as $hash => $key) {
                if (is_scalar($key) || $key instanceof ComparableInterface) {
                    $comparableKeys[$hash] = $key;
                } else {
                    $otherKeys[$hash] = $key;
                }
            }
            uasort(
                $comparableKeys,
                function ($key1, $key2) {
                    if ($key1 instanceof ComparableInterface) {
                        return $key1->compareTo($key2);
                    } elseif ($key2 instanceof ComparableInterface) {
                        switch ($key2->compareTo($key1)) {
                            case 1:
                                return -1;
                            case -1:
                                return 1;
                            default:
                                return 0;
                        }
                    } else {
                        return strnatcasecmp($key1, $key2);
                    }
                }
            );
            $this->keys = $comparableKeys + $otherKeys;
        } else {
            $comparator = $this->comparator;
            usort(
                $this->keys,
                function ($key1, $key2) use ($comparator) {
                    return $comparator->compare($key1, $key2);
                }
            );
        }

        $map = array();
        foreach ($this->keys as $hash => $key) {
            $map[$hash] = $this->values[$hash];
        }
        $this->values = $map;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function firstKey()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException();
        }

        $keys = array_values($this->keys);

        return reset($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function lastKey()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException();
        }

        $keys = array_values($this->keys);

        return end($keys);
    }
}
