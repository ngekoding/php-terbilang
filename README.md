# PHP Terbilang

PHP Terbilang is a library that converts number or currency amount into their Indonesian words representation.

## Features

- Converts number values to words in Indonesian.
- Converts currency amounts (in rupiah) to words.
- Supported decimals (comma) for both regular number and currency.

## Installation

You can install via composer:

```sh
composer require ngekoding/terbilang
```

## Usage

### Basic Usage

This is how to convert a regular number to words:

```php
use Ngekoding\Terbilang\Terbilang;

echo Terbilang::convert(12345); // Outputs: "dua belas ribu tiga ratus empat puluh lima"
echo Terbilang::convert(12345.67); // Outputs: "dua belas ribu tiga ratus empat puluh lima koma enam tujuh"
```

Then pass the second paramater to `true` for currency amount:

```php
echo Terbilang::convert(12345, true); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah"
echo Terbilang::convert(12345.67, true); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah enam puluh tujuh sen"
```

### Options

You can customize the decimal separator for your conversions:

```php
// Convert with a custom decimal separator (e.g., ',')
echo Terbilang::convert('12345,67', true, ','); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah enam puluh tujuh sen"

// Or you can change it globally
Terbilang::setDecimalSeparator(',');

echo Terbilang::convert('12345,67'); // Outputs: "dua belas ribu tiga ratus empat puluh lima koma enam tujuh"
echo Terbilang::convert('12345,25', true); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah dua puluh lima sen"
```

### Advanced Usage

You can use either numeric or string inputs, but there are some important considerations when dealing with decimals.

When using numeric input, trailing zeros after the decimal point are not preserved.  
For example, the number `12345.500` will be presented as `12345.5`.

To handle the entire decimal number (including trailing zeros), use string input.

```php
echo Terbilang::convert(12345.50); // Outputs: "dua belas ribu tiga ratus empat puluh lima koma lima"
echo Terbilang::convert('12345.50'); // Outputs: "dua belas ribu tiga ratus empat puluh lima koma lima nol"

echo Terbilang::convert(12345.50, true); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah lima sen"
echo Terbilang::convert('12345.50', true); // Outputs: "dua belas ribu tiga ratus empat puluh lima rupiah lima puluh sen"
```

Additionally, with string input, you can easily pass already formatted numbers.

```php
echo Terbilang::convert('Rp1.500.100,50', true, ','); // Outputs: "satu juta lima ratus ribu seratus rupiah lima puluh sen"
```

For currency amounts with `,00` decimals, the decimal part will be ignored, as this is the correct format for writing rupiah.

```php
echo Terbilang::convert('Rp1.500.100,00', true, ','); // Outputs: "satu juta lima ratus ribu seratus rupiah"
```

## API

```php
Terbilang::convert($number, $isCurrency = false, $decimalSeparator = null)
```

Converts a number or currency amount into its Indonesian words representation.

- **$number** (mixed): The number or currency amount to convert.
- **$isCurrency** (bool, optional): Whether the conversion is for currency (default: false).
- **$decimalSeparator** (string, optional): The decimal separator used in the number (default: '.').

## References

This library aims to adhere to Indonesian language standards.

- [Pedoman Umum Ejaan Bahasa Indonesia (PUEBI)](https://badanbahasa.kemdikbud.go.id/lamanbahasa/sites/default/files/PUEBI.pdf)
- [Kamus Besar Bahasa Indonesia (KBBI) Kemdikbud](https://kbbi.kemdikbud.go.id)

## Testing

```sh
composer test
```

## Contributing

Feel free to contribute to improve this library. Fork it, make changes, and submit a pull request.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
