<?php

namespace String;

use ArrayAccess;
use RuntimeException;

class Stringy implements ArrayAccess
{
    /**
     * String
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
     * Concatenate two strings
     *
     * @param array|string ...$strings
     *
     * @return static
     */
    public function concat(... $strings)
    {
        $value = $this->string;

        foreach ($strings as $string) {
            $value .= $string;
        }

        return new static($value);
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
     * @see ltrim()
     * @return static
     */
    public function leftTrim()
    {
        return new static(ltrim($this->string));
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
     * @param int $pos
     *
     * @return static
     */
    public function charAt($pos)
    {
        return $this->offsetGet($pos);
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
     * @see strlen()
     * @return int
     */
    public function length()
    {
        return strlen($this->string);
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
     * @param array ...$args
     *
     * @return static
     */
    public function format($args)
    {
        $string = call_user_func_array('sprintf', array_merge([$this->string], $args));

        return new static($string);
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
     * PHP magic __toString method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
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
     * @param mixed $value
     *
     * @return string
     */
    protected function str($value)
    {
        return (string) $value;
    }
}