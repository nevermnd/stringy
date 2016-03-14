<?php

namespace String;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use RuntimeException;

class Stringy implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * The string itself
     *
     * @var string
     */
    protected $string;

    /**
     * Stringy constructor.
     *
     * @param mixed $string
     */
    public function __construct($string = '')
    {
        $this->string = $this->str($string);
    }

    /**
     * PHP magic __invoke method
     *
     * @return static
     */
    public function __invoke()
    {
        return new static($this->string);
    }

    /**
     * PHP magic __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * @param int $pos
     *
     * @return static
     */
    public function charAt($pos)
    {
        return $this->offsetGet($pos);
    }

    /**
     * Concatenate two strings
     *
     * @param mixed ...$strings
     *
     * @return static
     */
    public function concat($strings)
    {
        $value = $this->string;

        foreach (func_get_args() as $string) {
            $value .= $string;
        }

        return new static($value);
    }

    /**
     * @param mixed $string
     *
     * @see strpos()
     * @return bool
     */
    public function contains($string)
    {
        return strpos($this->string, $this->str($string)) !== false;
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return strlen($this->string);
    }

    /**
     * Encode the html special characters of the string
     *
     * @see htmlspecialchars()
     * @return static
     */
    public function encode()
    {
        $encode = htmlspecialchars($this->string, ENT_QUOTES | ENT_SUBSTITUTE);

        return new static($encode);
    }

    /**
     * Check whether the two strings are equals
     *
     * @param string $other
     *
     * @return bool
     */
    public function equals($other)
    {
        return $this->string === $this->str($other);
    }

    /**
     * @param string $delimiter
     *
     * @see explode()
     * @return static[]
     */
    public function explode($delimiter)
    {
        $explode = explode($this->str($delimiter), $this->string);

        return $this->mapStrings($explode);
    }

    /**
     * @param mixed ...$args
     *
     * @return static
     */
    public function format($args)
    {
        $string = call_user_func_array('sprintf', array_merge([$this->string], func_get_args()));

        return new static($string);
    }

    /**
     * @see base64_decode()
     * @return static
     */
    public function fromBase64()
    {
        return new static(base64_decode($this->string));
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->split());
    }

    /**
     * @see md5()
     * @return static
     */
    public function hash()
    {
        return new static(md5($this->string));
    }

    /**
     * @see ltrim()
     * @return static
     */
    public function leftTrim()
    {
        return new static(ltrim($this->string));
    }

    /**
     * @see strlen()
     * @return int
     */
    public function length()
    {
        return $this->count();
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return isset($this->string[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return new static($this->string[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('offsetSet is not supported');
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        throw new RuntimeException('offsetUnset is not supported');
    }

    /**
     * @param string $search
     * @param string $replace
     *
     * @see str_replace()
     * @return static
     */
    public function replace($search, $replace)
    {
        return new static(str_replace($this->str($search), $this->str($replace), $this->string));
    }

    /**
     * @see rtrim()
     * @return static
     */
    public function rightTrim()
    {
        return new static(rtrim($this->string));
    }

    /**
     * @param int $offset
     * @param int $size
     *
     * @see substr()
     * @return static
     */
    public function slice($offset, $size = null)
    {
        return new static(substr($this->string, $offset, $size));
    }

    /**
     * @param int $size
     *
     * @see str_split()
     * @return static
     */
    public function split($size = 1)
    {
        return $this->mapStrings(str_split($this->string, $size));
    }

    /**
     * @see base64_encode()
     * @return static
     */
    public function toBase64()
    {
        return new static(base64_encode($this->string));
    }

    /**
     * Converts the string to lower case
     *
     * @see strtolower()
     * @return static
     */
    public function toLower()
    {
        return new static(strtolower($this->str($this->string)));
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->str($this);
    }

    /**
     * Converts the string to upper case
     *
     * @see strtoupper()
     * @return static
     */
    public function toUpper()
    {
        return new static(strtoupper($this->string));
    }

    /**
     * @see trim()
     * @return static
     */
    public function trim()
    {
        return new static(trim($this->string));
    }

    /**
     * @see ucfirst()
     * @return static
     */
    public function ucFirst()
    {
        return new static(ucfirst($this->string));
    }

    /**
     * @param array $strings
     *
     * @return array
     */
    protected function mapStrings($strings)
    {
        return array_map(function ($string) {

            return new static($string);

        }, $strings);
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    protected function str($value)
    {
        return (string) $value;
    }
}