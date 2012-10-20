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

use Countable, ArrayAccess, IteratorAggregate;
use UnexpectedValueException;
use Misd\Collections\Exception\NullPointerException,
    Misd\Collections\Exception\UnsupportedOperationException;

/**
 * Map.
 *
 * An object that maps keys to values. A map cannot contain duplicate keys;
 * each key can map to at most one value.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface MapInterface extends Countable, ArrayAccess, IteratorAggregate
{
    /**
     * Constructor.
     *
     * @param MapInterface|array $map Optional initial map.
     */
    public function __construct($map = array());

    /**
     * Maps a value to a key. If the map already contains a mapping for the
     * key, the old value is replaced.
     *
     * This is an optional operation.
     *
     * @param mixed $key   Key to which the value is to be associated.
     * @param mixed $value Value to be associated with the key.
     *
     * @return MapInterface A reference to the map.
     *
     * @throws NullPointerException          If the key or value is null and this collection does not permit null keys
     *                                       or values (optional).
     * @throws UnexpectedValueException      If the key or value is incompatible with this map (optional).
     * @throws UnsupportedOperationException If the `put` operation is not supported by this map.
     *
     * @see putAll
     */
    public function put($key, $value);

    /**
     * Copies all of the mappings from the specified map to this map.
     *
     * This is an optional operation.
     *
     * @param MapInterface|array $map Mappings to be stored in this map.
     *
     * @return MapInterface A reference to the map.
     *
     * @throws NullPointerException          If a key or value is null and this collection does not permit null keys or
     *                                       values (optional).
     * @throws UnexpectedValueException      If a key or value is incompatible with this map (optional).
     * @throws UnsupportedOperationException If the `putAll` operation is not supported by this map.
     *
     * @see put
     */
    public function putAll($map);

    /**
     * Returns the value to which the key is mapped, or null if this map
     * contains no mapping for the key.
     *
     * If this map permits null values, then a return value of null does not
     * necessarily indicate that the map contains no mapping for the key; it's
     * also possible that the map explicitly maps the key to null. The
     * {@see containsKey} operation may be used to distinguish these two cases.
     *
     * @param mixed $key Key whose associated value is to be returned.
     *
     * @return mixed|null Value to which the specified key is mapped, or null if there is no mapping for the key.
     *
     * @throws NullPointerException     If the key is null and this collection does not permit null keys (optional).
     * @throws UnexpectedValueException If the key is incompatible with this map (optional).
     */
    public function get($key);

    /**
     * Removes the mapping for a key from this map if it is present.
     *
     * This is an optional operation.
     *
     * @param mixed $key Key whose mapping is to be removed from the map.
     *
     * @return MapInterface A reference to the map.
     *
     * @throws NullPointerException          If the key is null and this map does not permit null keys (optional).
     * @throws UnexpectedValueException      If the key is incompatible with this map (optional).
     * @throws UnsupportedOperationException If the `remove` operation is not supported by this map.
     */
    public function remove($key);

    /**
     * Removes mappings for a collection of keys from this map if they are
     * present.
     *
     * This is an optional operation.
     *
     * @param SetInterface|array $keys Keys whose mappings are to be removed from the map.
     *
     * @return MapInterface A reference to the map.
     *
     * @throws NullPointerException          If a key is null and this map does not permit null keys (optional).
     * @throws UnexpectedValueException      If a key is incompatible with this map (optional).
     * @throws UnsupportedOperationException If the `removeAll` operation is not supported by this map.
     */
    public function removeAll($keys);

    /**
     * Removes all of the key-value mappings from this map.
     *
     * This is an optional operation.
     *
     * @return MapInterface A reference to the map.
     *
     * @throws UnsupportedOperationException If the `clear` operation is not supported by this map.
     */
    public function clear();

    /**
     * Returns `true` if this map contains a mapping for the specified key.
     *
     * @param mixed $key Key whose presence in this map is to be tested.
     *
     * @return bool `true` if this map contains a mapping for the specified key, otherwise `false`.
     *
     * @throws NullPointerException     If the key is null and this map does not permit null keys (optional).
     * @throws UnexpectedValueException If the key is incompatible with this map (optional).
     */
    public function containsKey($key);

    /**
     * Returns `true` if this map contains a mapping for all of the specified keys.
     *
     * @param CollectionInterface|array $keys Keys whose presence in this map is to be tested.
     *
     * @return bool `true` if this map contains a mapping for all of the specified keys, otherwise `false`.
     *
     * @throws NullPointerException     If a key is null and this map does not permit null keys (optional).
     * @throws UnexpectedValueException If a key is incompatible with this map (optional).
     */
    public function containsKeys($keys);

    /**
     * Returns `true` if this map maps one or more keys to the specified value.
     *
     * @param mixed $value Value whose presence in this map is to be tested.
     *
     * @return bool `true` if this map maps one or more keys to the value, otherwise `false`.
     *
     * @throws NullPointerException     If the value is null and this map does not permit null values (optional).
     * @throws UnexpectedValueException If the value is incompatible with this map (optional).
     */
    public function containsValue($value);

    /**
     * Returns `true` if this map maps one or more keys to all of the specified
     * values.
     *
     * @param CollectionInterface|array $values Values whose presence in this map is to be tested.
     *
     * @return bool `true` if this map maps one or more keys to all of the values, otherwise `false`.
     *
     * @throws NullPointerException     If a value is null and this map does not permit null values (optional).
     * @throws UnexpectedValueException If a value is incompatible with this map (optional).
     */
    public function containsValues($values);

    /**
     * Returns `true` if this map contains no key-value mappings.
     *
     * @return bool `true` if this map contains no key-value mappings, otherwise `false`.
     */
    public function isEmpty();

    /**
     * Returns a set view of the keys contained in this map.
     *
     * @return SetInterface Set view of the keys contained in this map.
     */
    public function keySet();

    /**
     * Returns a collection view of the values contained in this map.
     *
     * @return CollectionInterface Collection view of the values contained in this map.
     */
    public function values();
}
