<?php

if (!function_exists('str')) {

    /**
     * Returns a new String instance
     *
     * @param mixed $string
     *
     * @return \String\Stringy
     */
    function str($string)
    {
        return new String\Stringy($string);
    }
}