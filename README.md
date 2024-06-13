# PHP Terbilang

PHP Terbilang is a library that converts number or currency amount into their Indonesian words representation.

## Features

- Converts number values to words in Indonesian.
- Converts currency amounts (in rupiah) to words.
- Supported decimals (comma) for both regular number and currency.

## Installation

You can install via Composer. Run the following command:

```sh
composer require ngekoding/terbilang
```

## Usage

### Basic Usage

```php
use Ngekoding\Terbilang\Terbilang;

// Convert a regular number to words
echo Terbilang::convert(12345); // Outputs: "dua belas ribu tiga ratus empat puluh lima"

echo Terbilang::convert(12345.67); // Outputs: "dua belas ribu tiga ratus empat puluh lima koma enam tujuh"

// Convert a currency amount to words
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
```

**Note:** Use string input when you working with a decimals numbers and want get exactly as is the input value.

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

## Contributing

Feel free to contribute to improve this library. Fork it, make changes, and submit a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
