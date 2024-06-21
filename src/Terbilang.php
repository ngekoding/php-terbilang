<?php

namespace Ngekoding\Terbilang;

class Terbilang
{
    /**
     * Global decimal separator.
     * @var string
     */
    private static $decimalSeparator = '.';

    /**
     * Sets the global decimal separator.
     * 
     * @param string $decimalSeparator The new decimal separator to set.
     */
    public static function setDecimalSeparator($decimalSeparator)
    {
        self::$decimalSeparator = $decimalSeparator;
    }

    /**
     * Convert a numeric/currency value into its Indonesian words representation.
     *
     * @param mixed $number The number to convert.
     * @param bool $isCurrency Whether the conversion is for currency (default: false).
     * @param string $decimalSeparator The decimal separator (default: '.').
     * @return string The Indonesian words representation of the number/currency.
     */
    public static function convert($number, $isCurrency = false, $decimalSeparator = null)
    {
        if ($isCurrency) {
            return self::convertCurrencyNumber($number, $decimalSeparator);
        }

        return self::convertRegulerNumber($number, $decimalSeparator);
    }

    /**
     * Converts a number to its word representation in Indonesian language.
     *
     * If $number is a string, it's formatted as is the original number.
     * If $number is numeric, it's formatted using number_format() with allowed decimal places.
     *
     * @param mixed $number The number to convert.
     * @param string|null $decimalSeparator The decimal separator used in $number (default is class default).
     * @return string The word representation of the number.
     */
    public static function convertRegulerNumber($number, $decimalSeparator = null)
    {
        $decimalSeparator = $decimalSeparator ?: self::$decimalSeparator;

        if (is_string($number)) {
            // Separate integer and decimal parts
            $numberParts = explode($decimalSeparator, $number);
            $number = Helper::digitsOnly($numberParts[0]);
            $decimal = isset($numberParts[1]) ? Helper::digitsOnly($numberParts[1]) : null;
        } else {
            // Separate integer and decimal parts
            $numberParts = explode('.', $number);
            $number = intval($numberParts[0]);
            $decimal = isset($numberParts[1]) ? intval($numberParts[1]) : null;
        }

        $result = NumberToWordsConverter::convert($number);

        if ( ! empty($decimal)) {
            $result .= ' koma';
            
            $digitsWithZero = NumberToWordsConverter::$digits;
            $digitsWithZero[0] = 'nol';
            
            foreach (str_split($decimal) as $digit) {
                $result .= ' ' . $digitsWithZero[$digit];
            }
        }

        return $result;
    }

    /**
     * Converts a currency number to its word representation in Indonesian language.
     *
     * If $number is a string, it's formatted as is the original number.
     * If $number is numeric, it's formatted using number_format() with 2 decimal places.
     *
     * @param mixed $number The currency number to convert.
     * @param string|null $decimalSeparator The decimal separator used in $number (default is class default).
     * @return string The word representation of the currency amount.
     */
    public static function convertCurrencyNumber($number, $decimalSeparator = null)
    {
        $decimalSeparator = $decimalSeparator ?: self::$decimalSeparator;

        if (is_string($number)) {
            // Separate integer and decimal parts
            $numberParts = explode($decimalSeparator, $number);
            $number = Helper::digitsOnly($numberParts[0]);
            $decimal = isset($numberParts[1]) ? Helper::digitsOnly($numberParts[1]) : null;
        } else {
            // Indonesia currency commonly uses 2 decimals
            $number = number_format($number, 2, '.', '');
            
            // Separate integer and decimal parts
            $numberParts = explode('.', $number);
            $number = intval($numberParts[0]);
            $decimal = isset($numberParts[1]) ? intval($numberParts[1]) : null;
        }

        $result = NumberToWordsConverter::convert($number) . ' rupiah';

        if ( ! empty($decimal)) {
            $result .= ' ' . NumberToWordsConverter::convert($decimal) . ' sen';
        }

        return $result;
    }
}