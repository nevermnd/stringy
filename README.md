Stringy
=======
[![Build Status](https://travis-ci.org/nevermnd/stringy.svg?branch=master)](https://travis-ci.org/nevermnd/stringy)

Simple wrapper class for PHP string functions

Requirements
------------
The minimum requirement is PHP 5.4.

Usage
-----
Using the helper function `str()`

```php
  str('FooBar')->charAt(0)->length();
```

or creating a new instance manually

```php
  $string = new \String\Stringy('FooBarQux');  // 1
  $string->slice(3, 3)->equals('Bar');  // true
```
