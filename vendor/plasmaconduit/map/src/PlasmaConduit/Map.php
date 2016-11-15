<?php
namespace PlasmaConduit;
use PlasmaConduit\option\Some;
use PlasmaConduit\option\None;
use Exception;

/**
 * Class Map
 *
 * @package PlasmaConduit
 */
class Map {

    private $_value;

    /**
     * This is a convenience constructor for setting the initial
     * state of the `Map`
     *
     * @param array $value - The initial array to set the `Map` to
     */
    public function __construct(array $value = array()) {
        $this->_value = $value;
    }


    /**
     * This function returns a `Plasmaconduit\option\Some` containing the
     * the value of the key specified if it exists. If the key doesn't exist
     * this function returns a `PlasmaConduit\option\None` instead.
     *
     * @param mixed $key                    - The key of the value to fetch
     * @return \PlasmaConduit\option\Option - A `Some` w\ value or `None`
     */
    public function get($key) {
        if ($this->exists($key)) {
            return new Some($this->_value[$key]);
        } else {
            return new None();
        }
    }

    /**
     * If `$key` exists it returns the corresponding value otherwise it
     * returns `$alternative`.
     *
     * @param mixed $key                  - The key to fetch the value for
     * @param callable|mixed $alternative - The alternative value to return
     * @return mixed                      - The value or the alternative
     */
    public function getOrElse($key, $alternative) {
        return $this->get($key)->getOrElse($alternative);
    }

    /**
     * Sets the `$key` to `$value`
     *
     * @param mixed $key   - The key to set
     * @param mixed $value - The value to set the key to
     * @return mixed       - The set value
     */
    public function set($key, $value) {
        $this->_value[$key] = $value;
        return $this->_value[$key];
    }

    /**
     * Unsets the value for the specified key
     *
     * @param mixed $key - The key to unset
     * @return void
     */
    public function remove($key) {
        if ($this->exists($key)) {
            unset($this->_value[$key]);
        }
    }

    /**
     * Verifies the existence of `$key` in this `Map`
     *
     * @param mixed $key - The key to check for existence
     * @return bool      - True on existence, False otherwise
     */
    public function exists($key) {
        return array_key_exists($key, $this->_value);
    }

    /**
     * Pushes a value to the end of the map
     *
     * @param mixed - The value to push to the map
     * @return void
     */
    public function push($value) {
        $this->_value[] = $value;
    }

    /**
     * Pops a value off the end of the map
     *
     * @return mixed - The value popped of the end of the map
     */
    public function pop() {
        return array_pop($this->_value);
    }

    /**
     * Returns the current count of items in the `Map`
     *
     * @return int - The count of items in the `Map`
     */
    public function length() {
        return count($this->_value);
    }

    /**
     * Returns the keys of all items in the `Map`
     *
     * @return array - An array of the keys in the map
     */
    public function keys() {
        return array_keys($this->_value);
    }

    /**
     * Returns the values of all items in the `Map`
     *
     * @return array - An array of all the values in the map
     */
    public function values() {
        return array_values($this->_value);
    }

    /**
     * This returns the first value that satisfies the predicate
     *
     * @param Callable $predicate - The predicate to test for
     * @return \PlasmaConduit\option\Option
     */
    public function findValue($predicate) {
        foreach ($this->_value as $key => $value) {
            if ($predicate($value, $key)) {
                return new Some($value);
            }
        }
        return new None();
    }

    /**
     * This returns the first key that satisfies the predicate
     *
     * @param Callable $predicate - The predicate to test for
     * @return \PlasmaConduit\option\Option
     */
    public function findKey($predicate) {
        foreach ($this->_value as $key => $value) {
            if ($predicate($value, $key)) {
                return new Some($key);
            }
        }
        return new None();
    }

    /**
     * This just returns the array representation of the `Map`
     *
     * @return array - The array representation
     */
    public function toArray() {
        return $this->_value;
    }

    /**
     * Maps the supplied mapper function across the entire collection producing
     * new `Map` data structure
     *
     * @param Callable $mapper - The mapper to apply
     * @return Map             - The transformed `Map`
     * @throws Exception
     */
    public function map($mapper) {
        if (!is_callable($mapper)) {
            throw new Exception("Can't call Map#map() with non callable.");
        }
        return $this->reduce(new Map(), function(Map $m, $v, $k) use($mapper) {
            $m->set($k, $mapper($v, $k));
            return $m;
        });
    }

    /**
     * Reduces the collection with the supplied `$reducer`
     *
     * @param mixed $initial - The initial value of the reduction
     * @param $reducer
     * @return Map           - The transformed `Map`
     * @throws Exception
     */
    public function reduce($initial, $reducer) {
        if (!is_callable($reducer)) {
            throw new Exception(
                "Can't call Map#reduce() with non callable reducer."
            );
        }
        $memo = $initial;
        foreach ($this->_value as $key => $value) {
            $memo = $reducer($memo, $value, $key);
        }
        return $memo;
    }

    /**
     * Applies the `$predicate` to the entire collection keeping those that
     * pass and discarding those that fail
     *
     * @param Callable $predicate - The predicate to test for
     * @return Map                - A filtered `Map`
     * @throws Exception
     */
    public function filter($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception("Can't call Map#filter() with non callable.");
        }
        return $this->reduce(new Map(), function($m, $v, $k) use($predicate) {
            if ($predicate($v, $k)) {
                $m->set($k, $v);
            }
            return $m;
        });
    }

    /**
     * Returns a tuple of `Map`s where the first one are all elements
     * that satisfy `$predicate` and the other are the remainder.
     *
     * @param Callable $predicate - The predicate to test for
     * @return Map
     * @throws Exception
     */
    public function partition($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception(
                "Can't call Map#partition() with non callable."
            );
        }
        $init = new Map([new Map(), new Map()]);
        return $this->reduce($init, function($m, $v, $k) use($predicate) {
            if ($predicate($v, $k)) {
                $m->get(0)->get()->set($k, $v);
            } else {
                $m->get(1)->get()->set($k, $v);
            }
            return $m;
        });
    }

    /**
     * Returns a map of maps such that each map is representative of
     * the group set by the identifier on each element
     *
     * @param Callable $identifier - The identifier to group elements
     * @return Map
     * @throws Exception
     */
    public function groupBy($identifier) {
        if (!is_callable($identifier)) {
            throw new Exception(
                "Can't call Map#groupBy() with non callable"
            );
        }
        $init = new Map();
        return $this->reduce($init, function($m, $v, $k) use($identifier) {
            $key    = $identifier($v, $k);
            $bucket = $m->get($key)->orElse(function() {
                return new Some(new Map());
            })->get();
            $bucket->set($k, $v);
            $m->set($key, $bucket);
            return $m;
        });
    }

    /**
     * Calls the `$itterator` on every element in the collection
     *
     * @param $itterator
     * @throws \Exception
     */
    public function each($itterator) {
        if (!is_callable($itterator)) {
            throw new Exception("Can't call Map#each() with non callable.");
        }
        foreach ($this->_value as $key => $item) {
            $itterator($item, $key);
        }
    }

    /**
     * Returns a new collection of the difference of keys of this `Map`
     * and the one passed in.
     *
     * @param Map $other - The other map to get the difference from.
     * @return Map       - The calculated `Map`
     */
    public function differenceKey(Map $other) {
        return new Map(array_diff_key($this->_value, $other->toArray()));
    }

    /**
     * Returns a new collection with the difference of values of this `Map`
     * and the one passed in.
     *
     * @param Map $other - The other map to get the difference from.
     * @return Map       - The calculated `Map`
     */
    public function difference(Map $other) {
        return new Map(array_diff($this->_value, $other->toArray()));
    }

    /**
     * Returns a new collection thats the intersection of the keys of this `Map`
     * and the one passed in.
     *
     * @param Map $other - The other map to calculate the intersection from
     * @return Map       - The calculated `Map`
     */
    public function intersectionKey(Map $other) {
        return new Map(array_intersect_key($this->_value, $other->toArray()));
    }

    /**
     * Returns a new collection thats the intersection of this `Map` and the one
     * passed in.
     *
     * @param Map $other - The other map to calculate the intersection from
     * @return Map       - The calculated `Map`
     */
    public function intersection(Map $other) {
        return new Map(array_intersect($this->_value, $other->toArray()));
    }

    /**
     * Returns a new `Map` which is a merger of this `Map` and the one pased in
     *
     * @param Map $other
     * @return Map
     */
    public function merge(Map $other) {
        return new Map(array_merge($this->_value, $other->toArray()));
    }

    /**
     * Sorts the Map based on values. Returns a new sorted Map, doesn't mutate
     * the current map.
     *
     * @return Map - This map
     */
    public function sort() {
        $newMap = $this->_value;
        sort($newMap);
        return new Map($newMap);
    }

    /**
     * Sorts the Map based on keys. Returns a new sorted Map, doesn't mutate
     * the current map.
     *
     * @return Map - This map
     */
    public function keySort() {
        $newMap = $this->_value;
        ksort($newMap);
        return new Map($newMap);
    }

    /**
     * This function recursively traverses an array and transforms all
     * child encountered arrays into Maps
     *
     * @param Map|array $array - An array or map to mappify
     * @return Map             - The new deeply mappified map
     * @throws Exception
     */
    public static function mappify($array) {
        if (!is_array($array)) {
            throw new Exception("Can't call mappify with non array.");
        }
        $map = new Map($array);
        return $map->reduce(new Map(), function(Map $map, $value, $key) {
            if (is_array($value)) {
                $map->set($key, self::mappify($value));
            } else {
                $map->set($key, $value);
            }
            return $map;
        });
    }

}
