<?php

namespace Ngekoding\Terbilang;

use PHPUnit\Framework\TestCase;

class RegularNumberTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testConvert($number, $expectedResult)
    {
        $this->assertEquals($expectedResult, Terbilang::convert($number));
    }

    /**
     * @dataProvider dataProviderWithCustomDecimalSeparator
     */
    public function testConvertWithCustomDecimalSeparator($number, $expectedResult, $decimalSeparator)
    {
        $this->assertEquals($expectedResult, Terbilang::convert($number, false, $decimalSeparator));
    }

    public function testConvertWithGlobalCustomDecimalSeparator()
    {
        Terbilang::setDecimalSeparator(',');

        $this->assertEquals('satu juta koma lima tujuh', Terbilang::convert('1000000,57'));
        $this->assertEquals('dua belas juta koma tujuh satu', Terbilang::convert('12000000,71'));
    }

    public function dataProvider()
    {
        return [
            [-123, 'minus seratus dua puluh tiga'],
            [0, 'nol'],
            [1, 'satu'],
            [10, 'sepuluh'],
            [11, 'sebelas'],
            [20, 'dua puluh'],
            [21, 'dua puluh satu'],
            [100, 'seratus'],
            [101, 'seratus satu'],
            [110, 'seratus sepuluh'],
            [111, 'seratus sebelas'],
            [120, 'seratus dua puluh'],
            [121, 'seratus dua puluh satu'],
            [200, 'dua ratus'],
            [10000000000, 'sepuluh miliar'],
            [12345678901, 'dua belas miliar tiga ratus empat puluh lima juta enam ratus tujuh puluh delapan ribu sembilan ratus satu'],
            [98765432101, 'sembilan puluh delapan miliar tujuh ratus enam puluh lima juta empat ratus tiga puluh dua ribu seratus satu'],
            [123456789012, 'seratus dua puluh tiga miliar empat ratus lima puluh enam juta tujuh ratus delapan puluh sembilan ribu dua belas'],
            [100000000001, 'seratus miliar satu'],
            [1000000000000, 'satu triliun'],
            [1000000000001, 'satu triliun satu'],
            [1000000000100, 'satu triliun seratus'],
            [2000000000002, 'dua triliun dua'],
            [3000000000003, 'tiga triliun tiga'],
            [4000000000004, 'empat triliun empat'],
            [5000000000005, 'lima triliun lima'],
            [6000000000006, 'enam triliun enam'],
            [7000000000007, 'tujuh triliun tujuh'],
            [8000000000008, 'delapan triliun delapan'],
            [9000000000009, 'sembilan triliun sembilan'],
            [9876543210987, 'sembilan triliun delapan ratus tujuh puluh enam miliar lima ratus empat puluh tiga juta dua ratus sepuluh ribu sembilan ratus delapan puluh tujuh'],
            [12345678901234, 'dua belas triliun tiga ratus empat puluh lima miliar enam ratus tujuh puluh delapan juta sembilan ratus satu ribu dua ratus tiga puluh empat'],
            [1001001001001, 'satu triliun satu miliar satu juta seribu satu'],
            [21000000000000, 'dua puluh satu triliun'],
            [32100000000000, 'tiga puluh dua triliun seratus miliar'],
            [43210000000000, 'empat puluh tiga triliun dua ratus sepuluh miliar'],
            [54321000000000, 'lima puluh empat triliun tiga ratus dua puluh satu miliar'],
            [65432100000000, 'enam puluh lima triliun empat ratus tiga puluh dua miliar seratus juta'],
            [76543210000000, 'tujuh puluh enam triliun lima ratus empat puluh tiga miliar dua ratus sepuluh juta'],
            [87654321000000, 'delapan puluh tujuh triliun enam ratus lima puluh empat miliar tiga ratus dua puluh satu juta'],
            [98765432100000, 'sembilan puluh delapan triliun tujuh ratus enam puluh lima miliar empat ratus tiga puluh dua juta seratus ribu'],
            [999999999999999, 'sembilan ratus sembilan puluh sembilan triliun sembilan ratus sembilan puluh sembilan miliar sembilan ratus sembilan puluh sembilan juta sembilan ratus sembilan puluh sembilan ribu sembilan ratus sembilan puluh sembilan'],
            [1234567890123456, 'satu kuadriliun dua ratus tiga puluh empat triliun lima ratus enam puluh tujuh miliar delapan ratus sembilan puluh juta seratus dua puluh tiga ribu empat ratus lima puluh enam'],
            [123456.79, 'seratus dua puluh tiga ribu empat ratus lima puluh enam koma tujuh sembilan'],
            [100502.50, 'seratus ribu lima ratus dua koma lima'],
            [100502.505, 'seratus ribu lima ratus dua koma lima nol lima'],
            ['100502.50', 'seratus ribu lima ratus dua koma lima nol'],
            ['-1000000', 'minus satu juta'],
        ];
    }

    public function dataProviderWithCustomDecimalSeparator()
    {
        return [
            ['123456,79', 'seratus dua puluh tiga ribu empat ratus lima puluh enam koma tujuh sembilan', ','],
            ['100502#25', 'seratus ribu lima ratus dua koma dua lima', '#'],
        ];
    }
}
