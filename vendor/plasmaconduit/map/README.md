Map
===

[![Build Status](https://travis-ci.org/JosephMoniz/php-map.png?branch=master)](undefined)

A strongly typed more composable alternative to native associative arrays.
Influenced by Scala's immutable Map and makes use of `PlasmaConduit\option`.

```php
<?php
use PlasmaConduit\Map;

$isOdd  = function($n) { return $n % 2; };
$double = function($n) { return $n * 2; };

$oneToTen = Map([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
$doubleOfOddNumbers = $oneToTen->filter($isOdd)->map($double);
```

Public Interface
----------------
```php
<?php
namespace PlasmaConduit;

class Map {

    private $_value;

    /**
     * This is a convenience constructgor for setting the initial
     * state of the `Map`
     *
     * @param {array} $value - The initial array to set the `Map` to
     */
    public function __construct(array $value = array());


    /**
     * This function returns a `Plasmaconduit\option\Some` containing the
     * the value of the key specified if it exists. If the key doesn't exist
     * this function returns a `PlasmaConduit\option\None` instead.
     *
     * @param {Any} $key                     - The key of the value to fetch
     * @return {PlasmaConduit\option\Option} - A `Some` w\ value or `None`
     */
    public function get($key);

    /**
     * If `$key` exists it returns the corresponding value otherwise it
     * retursns `$alternative`.
     *
     * @param {Any} $key                  - The key to fetch the value for
     * @param {callable|Any} $alternative - The alternative value to return
     * @return {Any}                      - The value or the alternative
     */
    public function getOrElse($key, $alternative);

    /**
     * Sets the `$key` to `$value`
     *
     * @param {Any} $key   - The key to set
     * @param {Any} $value - The value to set the key to
     * @return {Any}       - The set value
     */
    public function set($key, $value);

    /**
     * Unsets the value for the specified key
     *
     * @param {Any} $key - The key to unset
     * @return {Void}
     */
    public function remove($key);

    /**
     * Verifies the existence of `$key` in this `Map`
     *
     * @param {Any} $key - The key to check for existence
     * @return {Boolean} - True on existence, False otherwise
     */
    public function exists($key)

    /**
     * Pushes a value to the end of the map
     *
     * @param {Any} - The value to push to the map
     * @return {Void}
     */
    public function push($value);

    /**
     * Pops a value off the end of the map
     *
     * @return {Any} - The value popped of the end of the map
     */
    public function pop();

    /**
     * Returns the current count of items in the `Map`
     *
     * @return {Number} - The count of items in the `Map`
     */
    public function length();

    /**
     * Returns the keys of all items in the `Map`
     *
     * @return {Array} - An array of the keys in the map
     */
    public function keys();

    /**
     * Returns the values of all items in the `Map`
     *
     * @return {Array} - An array of all the values in the map
     */
    public function values();

    /**
     * This returns the first value that satisfies the predicate
     *
     * @param {callable} $predicate - The predicate to test for
     * @return {PlasmaConduit\option\Option}
     */
    public function findValue($predicate);

    /**
     * This returns the first key that satisfies the predicate
     *
     * @param {callable} $predicate - The predicate to test for
     * @return {PlasmaConduit\option\Option}
     */
    public function findKey($predicate);

    /**
     * This just returns the array representation of the `Map`
     *
     * @return {Array} - The array representation
     */
    public function toArray();

    /**
     * Maps the supplied mapper function across the entire collection producing
     * new `Map` data structure
     *
     * @param {callable} $mapper - The mapper to apply
     * @return {Map}             - The transformed `Map`
     */
    public function map($mapper);

    /**
     * Reduces the collection with the supplied `$reducer`
     *
     * @param {Any} $initial - The initial value of the reduction
     * @return {Map}         - The transformed `Map`
     */
    public function reduce($initial, $reducer);

    /**
     * Applies the `$predicate` to the entire collection keeping those that
     * pass and discarding those that fail
     *
     * @param {callable} $predicate - The predicate to test for
     * @return {Map}                - A filtered `Map`
     */
    public function filter($predicate);

    /**
     * Returns a tuple of `Map`s where the first one are all elements
     * that satisfy `$predicate` and the other are the remainder.
     *
     * @param {callable} $predicate - The predicate to test for
     * @return {Map[Map, Map]}
     */
    public function partition($predicate);

    /**
     * Returns a map of maps such that each map is representative of
     * the group set by the identifier on each element
     *
     * @param {callable} $identifier - The identifier to group elements
     * @return {Map[Map ...]}
     */
    public function groupBy($identifier);

    /**
     * Calls the `$itterator` on every element in the collection
     *
     * @param {callable} $iterator - The itterator to run
     */
    public function each($itterator);

    /**
     * Returns a new collection of the difference of keys of this `Map`
     * and the one passed in.
     *
     * @param {Map} $other - The other map to get the difference from.
     * @return {Map}       - The calculated `Map`
     */
    public function differenceKey(Map $other);

    /**
     * Returns a new collection with the difference of values of this `Map`
     * and the one passed in.
     *
     * @param {Map} $other - The other map to get the difference from.
     * @return {Map}       - The calculated `Map`
     */
    public function difference(Map $other);

    /**
     * Returns a new collection thats the intersection of the keys of this `Map`
     * and the one passed in.
     *
     * @param {Map} $other - The other map to calculate the intersection from
     * @return {Map}       - The calculated `Map`
     */
    public function intersectionKey(Map $other);

    /**
     * Returns a new collection thats the intersection of this `Map` and the one
     * passed in.
     *
     * @param {Map} $other - The other map to calculate the intersection from
     * @return {Map}       - The calculated `Map`
     */
    public function intersection(Map $other);

    /**
     * Returns a new `Map` which is a merger of this `Map` and the one pased in
     *
     * @param {Map} $other - The other map to merge
     * @param {Map}        - The new map
     */
    public function merge(Map $other);

    /**
     * Sorts the Map based on values. Returns a new sorted Map, doesn't mutate
     * the current map.
     *
     * @return {Map} - This map
     */
    public function sort();

    /**
     * Sorts the Map based on keys. Returns a new sorted Map, doesn't mutate
     * the current map.
     *
     * @return {Map} - This map
     */
    public function keySort();

    /**
     * This function recursively traverses an array and transforms all
     * child encountered arrays into Maps
     *
     * @param {Map|array} $array - An array or map to mappify
     * @return {Map}             - The new deeply mappified map
     */
    public static function mappify($array);

}
```