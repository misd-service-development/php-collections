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
 * Abstract map.
 *
 * This provides a skeletal implementation of {@link MapInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable map: you must overwrite methods such as `put()`
 * to allow modification.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractMap implements MapInterface
{
    /**
     * Values in this map.
     *
     * @var array
     */
    protected $values;

    /**
     * Keys in this map.
     *
     * @var array
     */
    protected $keys;

    /**
     * {@inheritdoc}
     */
    public function __construct($map = array())
    {
        $this->values = array();
        $this->keys = array();

        if ($map instanceof MapInterface) {
            $this->values = $map->values()->toArray();
            $this->keys = $map->keySet()->toArray();
        } else {
            foreach ($map as $key => $value) {
                $hash = $this->hashKey($key);
                $this->values[$hash] = $value;
                $this->keys[$hash] = $key;
            }
        }
    }

    /**
     * Hash a key.
     *
     * @param mixed $key Key to be hashed.
     *
     * @return string|int Hashed key.
     */
    protected function hashKey($key)
    {
        if ($key instanceof \DateTime) {
            return '_' . $key->format('c');
        } elseif (is_object($key)) {
            return '_' . spl_object_hash($key);
        } elseif (false === $key) {
            return '_false';
        } elseif (true === $key) {
            return '_true';
        } elseif (null === $key) {
            return '_null';
        } elseif (is_array($key)) {
            return '_' . md5(json_encode(array_multisort($key)));
        } elseif (is_int($key)) {
            return $key;
        } else {
            return (string) $key;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function put($key, $value)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function putAll($map)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $hash = $this->hashKey($key);

        return array_key_exists($hash, $this->values) ? $this->values[$hash] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function removeAll($keys)
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * {@inheritdoc}
     */
    public function containsKey($key)
    {
        return array_key_exists($this->hashKey($key), $this->values);
    }

    /**
     * {@inheritdoc}
     */
    public function containsKeys($keys)
    {
        foreach ($keys as $key) {
            if (false === $this->containsKey($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function containsValue($value)
    {
        return in_array($value, $this->values);
    }

    /**
     * {@inheritdoc}
     */
    public function containsValues($values)
    {
        foreach ($values as $value) {
            if (false === $this->containsValue($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->values());
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return 0 === $this->count();
    }

    /**
     * {@inheritdoc}
     */
    public function keySet()
    {
        return new HashSet($this->keys);
    }

    /**
     * {@inheritdoc}
     */
    public function values()
    {
        return new ArrayList($this->values);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->values[] = $value;
        } else {
            $this->values[$offset] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->values[$offset]) ? $this->values[$offset] : null;
    }
}
