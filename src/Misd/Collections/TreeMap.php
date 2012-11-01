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

use Misd\Collections\Comparison\ComparatorInterface;

/**
 * The map is sorted according to the natural ordering of its keys, or by a
 * Comparator provided at map creation time, depending on which constructor is
 * used.
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
            $scalarKeys = array();
            $otherKeys = array();
            foreach ($this->keys as $hash => $key) {
                if (is_scalar($key)) {
                    $scalarKeys[$hash] = $key;
                } else {
                    $otherKeys[$hash] = $key;
                }
            }
            natsort($scalarKeys);
            $this->keys = $scalarKeys + $otherKeys;
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
}
