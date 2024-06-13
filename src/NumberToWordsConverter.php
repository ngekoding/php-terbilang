<?php

namespace Ngekoding\Terbilang;

use Ngekoding\Terbilang\Exception\NotNumberException;

class NumberToWordsConverter
{
    /**
     * Array mapping digits to their Indonesian word equivalents.
     * @var array
     */
    public static $digits = [
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
    ];

    /**
     * Array defining the bases and their corresponding Indonesian word units.
     * @var array
     */
    public static $bases = [
        1000000000000000000 => 'kuintiliun',
        1000000000000000 => 'kuadriliun',
        1000000000000 => 'triliun',
        1000000000 => 'miliar',
        1000000 => 'juta',
        1000 => 'ribu',
        100 => 'ratus',
    ];

    /**
     * Convert a numeric value into its Indonesian words representation.
     *
     * @param int $number The number to convert.
     * @return string The Indonesian words representation of the number.
     * @throws NotNumberException If the input is not a valid number.
     */
    public static function convert($number)
    {
        if ( ! is_numeric($number)) {
            throw new NotNumberException('The input must be a number.');
        }

        if ($number == 0) {
            return 'nol';
        }

        $result = '';

        if ($number < 0) {
            $number = abs($number);
            $result = 'minus ';
        }
    
        foreach (self::$bases as $base => $unit) {
            if ($number >= $base) {
                $remaining = floor($number / $base);
                $number %= $base;
    
                if ($remaining == 1) {
                    $result .= ' ' . ($base <= 1000 ? 'se' : 'satu ') . $unit;
                } else {
                    $result .= ' ' . self::convert($remaining) . ' ' . $unit;
                }
            }
        }
    
        if ($number < 12) {
            $result .= ' ' . self::$digits[$number];
        } elseif ($number < 20) {
            $result .= ' ' . self::$digits[$number - 10] . ' belas';
        } else {
            $remaining = floor($number / 10);
            $number %= 10;
            $result .= ' ' . self::$digits[$remaining] . ' puluh ' . ($number > 0 ? self::convert($number) : '');
        }
        
        return trim(preg_replace('/\s+/', ' ', $result));
    }
}