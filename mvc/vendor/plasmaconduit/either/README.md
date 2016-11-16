Either
======

[![Build Status](https://travis-ci.org/JosephMoniz/php-either.png?branch=master)](undefined)

A strongly typed composable alternative to exceptions and functions that return
error codes or sane values.

The convention is that `Left` is representative of an error value and `Right`
is representative of a success value.

```php
<?php
use PlasmaConduit\either\Left;
use PlasmaConduit\either\Right;
use PlasmaConduit\option\Some;
use PlasmaConduit\option\None;

function loadNews() {
    $connection = PsuedoDB::connect();
    if (!$connection) {
        return new Left("Failed connection to DB");
    }

    $news = $connection->get("latestNews");
    if ($news) {
        return new Right($news);
    } else {
        return new Left("Failed reading latest news");
    }
}

$news = loadNews()->fold(
    function($failMessage) {
        PsudeoLogger::log($failMessage);
        return new None();
    },
    function($news) {
        return new Some($news);
    }
)->getOrElse("No news at the moment, please check back later.");

```

Documentation
-------------
This library implements a classes `Left` and `Right` and they both implement the
`Either` interface. The `Either` interface is as follows:
```php
<?php
namespace PlasmaConduit\either;

interface Either {

    /**
     * Returns true if this `Either` type is `Left`, false otherwise
     *
     * @return {Boolean}
     */
    public function isLeft();

    /**
     * Returns true if this `Either` type is `Right`, false otherwise
     *
     * @return {Boolean}
     */
    public function isRight();

    /**
     * This function takes two callable types as it's arguments and it will
     * only call one of them. If this `Either` type is `Left` it calls
     * `$leftCase` with the left value. If this is the `Right` type it calls
     * the `$rightCase` with the right value.
     *
     * @param {callable} $leftCase  - Callable for left case
     * @param {callable} $rightCase - Callable for right case
     * @return {Any}                - Whatever the ran case returns
     */
    public function fold($leftCase, $rightCase);

    /**
     * Returns an `Option` projection of the `Left` value of this `Either` type.
     * So if this is type `Left` it returns `Some($value)` but if this is
     * `Right` it returns `None`
     *
     * @return {PlasmaConduit\option\Option}
     */
    public function left();

    /**
     * Returns an `Option` projection of the `Right` value of this `Either`
     * type. So if this is type `Right` it returns `Some($value)` but if this is
     * `Left` it returns `None`
     *
     * @return {PlasmaConduit\option\Option}
     */
    public function right();

    /**
     * Returns the `Either` type as the opposite side. `Left` returns `Right`
     * and vice versa.
     *
     * @return {Either}
     */
    public function swap();

}
```
