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
use Misd\Collections\Exception\UnsupportedOperationException;

/**
 * This provides a skeletal implementation of {@link MapInterface}, to
 * minimize the effort required to implement this interface.
 *
 * This is an immutable map: you must overwrite methods such as `put()`
 * to allow modification.
 *
 * Due to limitations in PHP, when using the map like an associative array the
 * key will actually be a hashed form of the key. You will need to use `key()`
 * to obtain the real key value:
 *
 * <code>
 * foreach ($map as $hash => $value) {
 *     $key = $map->key($hash);
 * </code>
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
            return md5('_' . $key->format('c'));
        } elseif (is_object($key)) {
            return spl_object_hash($key);
        } elseif (false === $key) {
            return md5('_false');
        } elseif (true === $key) {
            return md5('_true');
        } elseif (null === $key) {
            return md5('_null');
        } elseif (is_array($key)) {
            array_multisort($key);

            return md5(json_encode($key));
        } elseif (is_int($key)) {
            return md5('_' . $key);
        } elseif (is_float($key)) {
            return md5('_' . $key);
        } else {
            return md5($key);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function key($hash)
    {
        if (false === isset($this->keys[$hash])) {
            throw new UnexpectedValueException();
        }

        return $this->keys[$hash];
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
