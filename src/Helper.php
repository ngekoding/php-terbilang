<?php

namespace Ngekoding\Terbilang;

class Helper
{
    /**
     * Removes non-numeric characters from a string and returns the result as an integer.
     *
     * @param string $input The input string to be cleaned.
     * @return int The cleaned string converted to an integer.
     */
    public static function digitsOnly($str)
    {
        return intval(preg_replace('/(?!^-)[^\d]/', '', $str));
    }
}