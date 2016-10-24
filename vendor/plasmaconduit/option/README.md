Option
======

[![Build Status](https://travis-ci.org/JosephMoniz/php-option.png?branch=master)](undefined)

Strongly typed alternative to null. The Option type in this package is based
off of the Option typeclass from Scala and the Maybe monad from Haskell.

`Option` itself is just an interface. Two classes in this package implement
the `Option` interface and they are `Some` and `None`. The convention is to
have functions return `Option` types and it will either contain `Some` value
or `None` at all. This creates a type safe alternative to returning null in
the absence of a value.

In addition to the added type safety, the `Option` type is monadic, so
`Option` types are highly composable. This allows you to eliminate a lot of
the typical null checking boiler plate code you'd normally have to write and
encourages you to write in a more expressive style.

```php
<?php
use PlasmaConduit\option\Some;
use PlasmaConduit\option\None;

function fetchUser($username) {
    $user = PsuedoDB::get($username);
    if ($user) {
        return new Some($user);
    } else {
        return new None();
    }
}

function updateLastSeen($username) {
    PsuedoDB::updateLastSeen($username);
    return $username;
}

// Fetch the user "Joseph". If "Joseph" exists update the last time he was seen
// and echo "Joseph". If "Joseph" doesn't exist do not update the last time
// any user was seen and print out "No such user." instead.
echo fetchUser("Joseph")->map("updateLastSeen")->getOrElse("No such user.");
```

Documentation
-------------
This library implements two classes that both implement the `Option` interface.
These classes are `Some` and `None`.

The `Option` interface is as follows
```php
<?php
namespace PlasmaConduit\option;

interface Option {

    /**
     * This function is used to signify if the Option type is empty.
     *
     * @return {Boolean} - True on empty false on non empty
     */
    public function isEmpty();

    /**
     * This function is used to signify if the Option type is not empty.
     *
     * @return {Boolean} - True on non empty false on empty
     */
    public function nonEmpty();

    /**
     * This returns the wrapped value. Throws when called on `None`.
     * So the convention goes, this should never be called on `None`
     *
     * @throws {Exception} - When called on `none`
     * @return {Any}       - The wrapped value
     */
    public function get();

    /**
     * This function will return the wrapped value if the `Option` type is
     * `Some` and if it's `None` it will return `$default` instead.
     *
     * @ param {Any} $default - The default value if no value is present
     * @ return {Any}         - The wrapped valueor the supplied default
     */
    public function getOrElse($default);

    /**
     * This function takes an alternative `Option` type or callable and if
     * this `Option` type is `None` it returns the evalutated alternative type.
     *
     * @param {callable|Option} $alternative - The alternative Option
     * @return {Option}                      - Itself or the alternative
     */
    public function orElse($alternative);

    /**
     * For those moments when you just need either a value or null. This
     * function returns the wrapped value when called on the `Some` class and
     * returns null when called on the `None` class. 
     *
     * @return {Any|null} - The wrapped value or null
     */
    public function orNull();

    /**
     * Not yet implemented
     */
    public function toLeft($right);

    /**
     * Not yet implemented
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
     * @param {callable} $mapper - Function to call on the wrapped value
     * @return {Option}          - The newly produced `Some` or `None`
     */
    public function map($mapper);

    /**
     * This method takes a callable type that takes the wrapped value of the
     * current `Some` as it's arguments and returns an `Option` type. The
     * `Option` type returned by the passed in callable is returned by this
     * method. If this is `None`, it behaves just like Option#map()
     *
     * @param {callable} $flatMapper - Fuction to call on the wrapped value
     * @return {Option}              - The new `Option`
     */
    public function flatMap($flatMapper);

    /**
     * This function takes a callable as a predicate that takes the wrapped
     * value of the current `Some` as it's argument. If the predicate returns
     * true the current `Some` is returned. If the predicate returns false
     * a new `None` is returned. If this is a `None` the predicate is never
     * evaluated and `None` is returned immediately
     *
     * @param {callable} $predicate - The predicate to check the wrapped value
     * @return {Option}             - `Some` on success `None` on failure
     */
    public function filter($predicate);

}
```

Developing
----------
This section is really only useful if you plan on contributing to this project.
You're going to need composer in the root directory so you can fetch all the
projects dependencies and to setup the autoloader.
```
curl http://getcomposer.org/installer | php
php composer.phar install --dev
```

Testing
-------
This section assumes you already followed the steps in `Developing`
```
bin/phpspec run
```