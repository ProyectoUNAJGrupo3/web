<?php
namespace PlasmaConduit\option;
use Exception;
use PlasmaConduit\either\Either;

/**
 * Class Option
 *
 * @package PlasmaConduit\option
 */
interface Option {

    /**
     * This function is used to signify if the Option type is empty.
     *
     * @return bool - True on empty false on non empty
     */
    public function isEmpty();

    /**
     * This function is used to signify if the Option type is not empty.
     *
     * @return bool - True on non empty false on empty
     */
    public function nonEmpty();

    /**
     * This returns the wrapped value. Throws when called on `None`.
     * So the convention goes, this should never be called on `None`
     *
     * @throws Exception
     * @return mixed
     */
    public function get();

    /**
     * This function will return the wrapped value if the `Option` type is
     * `Some` and if it's `None` it will return `$default` instead.
     *
     * @param mixed $default - The default value if no value is present
     * @return mixed         - The wrapped value or the supplied default
     */
    public function getOrElse($default);

    /**
     * This function takes an alternative `Option` type or callable and if
     * this `Option` type is `None` it returns the evaluated alternative type.
     *
     * @param Callable|Option $alternative - The alternative Option
     * @return Option                      - Itself or the alternative
     */
    public function orElse($alternative);

    /**
     * For those moments when you just need either a value or null. This
     * function returns the wrapped value when called on the `Some` class and
     * returns null when called on the `None` class.
     *
     * @return mixed|null - The wrapped value or null
     */
    public function orNull();

    /**
     * Returns a `Left` projection with the wrapped value when called on a
     * `Some. Otherwise it returns a `Right` projection containing the
     * evaluated value of `$right`.
     *
     * @param Callable|mixed $right - The alternative `Right` projection
     * @return Either               - The projected `Either` value
     */
    public function toLeft($right);

    /**
     * Returns a `Right` projection with the wrapped value when called on a
     * `Some. Otherwise it returns a `Left` projection containing the
     * evaluated value of `$left`.
     *
     * @param Callable|mixed $left - The alternative `Left` projection
     * @return Either              - The projected `Either` value
     */
    public function toRight($left);

    /**
     * This method takes a callable type (closure, function, etc) and if it's
     * called on a `Some` instance it will call the function `$mapper` with the
     * wrapped value and the value returend by `$mapper` will be wrapped in a
     * new `Some` container and that new `Some` container will be returned. If
     * this is called on a `None` container, the function `$mapper` will never
     * be called and instead we return `None` immediately.
     *
     * @param Callable $mapper - Function to call on the wrapped value
     * @return Option          - The newly produced `Some` or `None`
     */
    public function map($mapper);

    /**
     * This method takes a callable type that takes the wrapped value of the
     * current `Some` as it's arguments and returns an `Option` type. The
     * `Option` type returned by the passed in callable is returned by this
     * method. If this is `None`, it behaves just like Option#map()
     *
     * @param Callable $flatMapper - Fuction to call on the wrapped value
     * @return Option              - The new `Option`
     */
    public function flatMap($flatMapper);

    /**
     * This function takes a callable as a predicate that takes the wrapped
     * value of the current `Some` as it's argument. If the predicate returns
     * true the current `Some` is returned. If the predicate returns false
     * a new `None` is returned. If this is a `None` the predicate is never
     * evaluated and `None` is returned immediately
     *
     * @param Callable $predicate - The predicate to check the wrapped value
     * @return Option             - `Some` on success `None` on failure
     */
    public function filter($predicate);

}