<?php

namespace Ngekoding\Terbilang;

use PHPUnit\Framework\TestCase;

class CurrencyNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testConvert($number, $expectedResult)
    {
        $this->assertEquals($expectedResult, Terbilang::convert($number, true));
    }

    /**
     * @dataProvider dataProviderWithCustomDecimalSeparator
     */
    public function testConvertWithCustomDecimalSeparator($number, $expectedResult, $decimalSeparator)
    {
        $this->assertEquals($expectedResult, Terbilang::convert($number, true, $decimalSeparator));
    }

    public function dataProvider()
    {
        return [
            [0, 'nol rupiah'],
            [1, 'satu rupiah'],
            [10, 'sepuluh rupiah'],
            [11, 'sebelas rupiah'],
            [19, 'sembilan belas rupiah'],
            [20, 'dua puluh rupiah'],
            [21, 'dua puluh satu rupiah'],
            [99, 'sembilan puluh sembilan rupiah'],
            [100, 'seratus rupiah'],
            [101, 'seratus satu rupiah'],
            [110, 'seratus sepuluh rupiah'],
            [111, 'seratus sebelas rupiah'],
            [999, 'sembilan ratus sembilan puluh sembilan rupiah'],
            [1000, 'seribu rupiah'],
            [1001, 'seribu satu rupiah'],
            [1010, 'seribu sepuluh rupiah'],
            [1011, 'seribu sebelas rupiah'],
            [123456, 'seratus dua puluh tiga ribu empat ratus lima puluh enam rupiah'],
            [999999, 'sembilan ratus sembilan puluh sembilan ribu sembilan ratus sembilan puluh sembilan rupiah'],
            [1000000, 'satu juta rupiah'],
            [1234567, 'satu juta dua ratus tiga puluh empat ribu lima ratus enam puluh tujuh rupiah'],
            [1000000000, 'satu miliar rupiah'],
            [9876543210, 'sembilan miliar delapan ratus tujuh puluh enam juta lima ratus empat puluh tiga ribu dua ratus sepuluh rupiah'],
            [200000000, 'dua ratus juta rupiah'],
            [900500.5, 'sembilan ratus ribu lima ratus rupiah lima puluh sen'],
            [900500.50, 'sembilan ratus ribu lima ratus rupiah lima puluh sen'],
            [900500.505, 'sembilan ratus ribu lima ratus rupiah lima puluh satu sen'],
            ['900500.500', 'sembilan ratus ribu lima ratus rupiah lima ratus sen'],
          ];
    }

    public function dataProviderWithCustomDecimalSeparator()
    {
        return [
            ['970800,78', 'sembilan ratus tujuh puluh ribu delapan ratus rupiah tujuh puluh delapan sen', ','],
            ['160500#25', 'seratus enam puluh ribu lima ratus rupiah dua puluh lima sen', '#'],
            ['-Rp1.000.000,00', 'minus satu juta rupiah', ','],
          ];
    }
}
