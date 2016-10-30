<?php
namespace PlasmaConduit\option;
use PlasmaConduit\either\Left;
use PlasmaConduit\either\Right;
use PlasmaConduit\option\Option;
use Exception;

/**
 * Class None
 *
 * @package PlasmaConduit\option
 */
class None implements Option {

    /**
     * This constructor does absolutely nothing
     */
    public function __construct() { /**/ }

    /**
     * This function is used to signify if the Option type is empty. This is
     * the `None` class and the class type carries this information so this
     * method will always return true.
     *
     * @return bool - Always true
     */
    public function isEmpty() {
        return true;
    }

    /**
     * This function is used to signify if the Option type is not empty. This
     * is the `None` class and the class type carries this information so this
     * method will always return false.
     *
     * @return bool - Always false
     */
    public function nonEmpty() {
        return false;
    }

    /**
     * This method should never be called because you can't get a value from
     * nothing. So this throws unconditionally.
     *
     * @throws Exception
     */
    public function get() {
        throw new Exception("None#get() should never be called");
    }

    /**
     * This function will return the wrapped value if the `Option` type is
     * `Some` and if it's `None` it will return `$default` instead. Seeing how
     * this is the `None` class, this will always return the `$default`
     *
     * @param mixed $default - The default value if no value is present
     * @return mixed         - The `$default` value
     */
    public function getOrElse($default) {
        if (is_callable($default)) {
            return $default();
        } else {
            return $default;
        }
    }

    /**
     * This function takes an alternative `Option` type or a callable and if
     * this `Option` type is `None` it returns the evaluated alternative type.
     * However, this is the `None` class so it will always return
     * the evaluated `$alternative`.
     *
     * @param Callable|Option $alternative - The alternative Option
     * @return Option                      - Always returns `$alternative`
     * @throws Exception
     */
    public function orElse($alternative) {
        if (!is_callable($alternative) && !($alternative instanceof Option)) {
            throw new Exception(
                "Can't call Some#orElse() with non option or callable"
            );
        }

        if ($alternative instanceof Option) {
            return $alternative;
        } else {
            $evaluated = $alternative();
            if (!($evaluated instanceof Option)) {
                throw new Exception(
                    "Result of alternative must return an `Option` type"
                );
            }
            return $evaluated;
        }
    }

    /**
     * For those moments when you just need either a value or null. This
     * function returns the wrapped value when called on the `Some` class and
     * returns null when called on the `None` class. This is the `None` class
     * so it will always return null
     *
     * @return null - Always null
     */
    public function orNull() {
        return null;
    }

    /**
     * This returns the evaluated value of `$right` as a `Right` projection.
     *
     * @param callable|mixed $right - The alternative `Right` value
     * @return Either               - The alternative `Right` value
     */
    public function toLeft($right) {
        if (is_callable($right)) {
            return new Right($right());
        } else {
            return new Right($right);
        }
    }

    /**
     * This returns the evaluated value of `$left` as a `Left` projection.
     *
     * @param Callable|mixed $left - The alternative `Left` value
     * @return Either               - The alternative `Left` value
     */
    public function toRight($left) {
        if (is_callable($left)) {
            return new Left($left());
        } else {
            return new Left($left);
        }
    }

    /**
     * This method takes a callable type (closure, function, etc) and if it's
     * called on a `Some` instance it will call the function `$mapper` with the
     * wrapped value and the value returend by `$mapper` will be wrapped in a
     * new `Some` container and that new `Some` container will be returned. If
     * this is called on a `None` container, the function `$mapper` will never
     * be called and instead we return `None` immediately. This is the `None`
     * class, so it will never call the `$mapper` and will return `None`
     * immediately.
     *
     * @param Callable $mapper - Function to disregard
     * @return Option          - Always `None`
     * @throws Exception
     */
    public function map($mapper) {
        if (!is_callable($mapper)) {
            throw new Exception("Can't call Some#map with a non callable.");
        }
        return $this;
    }

    /**
     * This takes a callable and completely disregards it, returning `None`
     * immediately.
     *
     * @param Callable $flatMapper
     * @return $this|Option
     * @throws \Exception
     */
    public function flatMap($flatMapper) {
        if (!is_callable($flatMapper)) {
            throw new Exception("Can't call Some#flatMap with a non callable.");
        }
        return $this;
    }

    /**
     * This function takes a callable as a predicate, disregards it and returns
     * `None` immediately
     *
     * @param Callable $predicate
     * @return $this|Option
     * @throws \Exception
     */
    public function filter($predicate) {
        if (!is_callable($predicate)) {
            throw new Exception("Can't call Some#filter with a non callable.");
        }
        return $this;
    }

}
