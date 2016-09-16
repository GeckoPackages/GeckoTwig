#### GeckoPackages

# Twig extensions

Provides additional filters and tests to be used with [Twig](http://twig.sensiolabs.org).

#### Filters
- **Bytes**
  Formats a number of bytes with binary or SI prefix multiple, either automatically or by given symbol.
- **File Permissions**
  Formats file permissions in symbolic (UNIX) notation.
- **Lower Roman**
  Lowercase Roman numerals in a string.
- **SI**
  Formats a number with a SI symbol, either automatically or by given symbol.
- **Upper First**
  Uppercase the first character of a string.
- **Upper Roman**
  Uppercase Roman numerals in a string.

#### Tests
- **Numeric**
  Test given value is numeric (behaviour like PHP 7 `is_numeric`).

See below for details.

### Requirements

PHP 5.4 (PHP7 supported). Optional HHVM support >= 3.9.

### Install

The package can be installed using [Composer](https://getcomposer.org/).
Add the package to your `composer.json`.

```
"require": {
    "gecko-packages/gecko-twig" : "^1.0"
}
```

# Package listing

## Filters

### BytesFilter
###### GeckoPackages\Twig\Filters\BytesFilter
Formats a number of bytes to a specific SI or binary unit or in a auto (best match) way.
Specific units of IEC 60027-2 A.2 (1024 based) or SI (1000 based) are supported.
(https://en.wikipedia.org/wiki/Binary_prefix)
(https://en.wikipedia.org/wiki/Metric_prefix#List_of_SI_prefixes)

Symbols supported:

| binary      | SI            |
| ----------- | ------------- |
| b  (bit)    | b     (bit)   |
| B  (byte)   | B     (byte)  |
| Ki (kibi)   | k(/K) (kilo)  |
| Mi (mebi)   | M     (mega)  |
| Gi (gibi)   | G     (giga)  |
| Ti (tebi)   | T     (tera)  |
| Pi (pebi)   | P     (peta)  |
| Ei (exbi)   | E     (exa)   |
| Zi (zebi)   | Z     (zetta) |
| Yi (yobi)   | Y     (yotta) |
| 'auto,bin'  | 'auto,SI'     |

The default is `auto,bin`.

#### Examples

```Twig

{{ 1099511627776|bytes }}
{# 1TiB #}

{{ 1000|bytes('auto,SI') }}
{# 1KB #}

{{ (1024*2)|bytes('Kib') }}
{# 16Kib #}

{{ (250.5 * 1048576)|bytes('auto,bin', '%number% %symbol%', 4, ',', '') }}
{# 250,5000 MiB #}

```

The filter uses the number formatting set on the `Core` extension of Twig. The output can be customized even more by passing a `format`.

### FilePermissionsFilter
###### GeckoPackages\Twig\Filters\FilePermissionsFilter
Formats file permissions in symbolic (UNIX) notation.

#### Examples

```Twig

{{ 755|filePermissions}}
{# urwxr-xr-x #}

{{ './'|filePermissions}}
{# drwxrwxr-x #}

{{ '0444'|filePermissions}}
{# ur--r--r-- #}

```

### LowerRomanFilter
###### GeckoPackages\Twig\Filters\LowerRomanFilter
Lowercase Roman numerals in a string.
Supports the Roman numerals in modern notation (`strict`) or `loose` notation.

| Roman | Value |
| ----- |------ |
| I     |    1  |
| IV    |    4  |
| V     |    5  |
| IX    |    9  |
| X     |   10  |
| XL    |   40  |
| L     |   50  |
| XC    |   90  |
| C     |  100  |
| CD    |  400  |
| D     |  500  |
| CM    |  900  |
| M     | 1000  |

Note: large numbers, for example in 'apostrophus' and 'vinculum' are not supported.

In `strict` mode:
- Symbols are combined from left to right, high to low values.
- Symbols are not repeated more than 3 times.
- C may b placed after D or M.
- X may be placed before L or C.
- I may be placed before V or X.
- This makes the maximum number supported 'MMMCMXCIX'.

In `loose` mode, follows `strict` mode with the following exceptions:
- Symbols may be repeated more than 3 times.
- There is no more maximum number.

In `loose-order`, follows `loose` mode with the following exception:
- Symbols may appear in any order.

More details: https://en.wikipedia.org/wiki/Roman_numerals

The default mode is `strict`.

#### Examples

```Twig

{{ 'MCMLIV. Chapter sub XI NOT XICA'|lowerRoman }}
{# mcmliv. Chapter sub xi NOT XICA #}

{{ 'IIXX, XIiX, III, MDcdIII, TESTXI, MMMM'|lowerRoman('loose-order') }}
{# iixx, xiix, iii, mdcdiii, TESTXI, mmmm #}

```

### SIFilter
###### GeckoPackages\Twig\Filters\SIFilter
Formats a number with a SI symbol, either automatically or by given symbol.
(https://en.wikipedia.org/wiki/Metric_prefix#List_of_SI_prefixes)

Symbols supported:

| Symbol | Description             |               |                                     |
| ------ | ----------------------- | ------------- | ----------------------------------- |
| y      | yocto                   | septillionth  | 0.000 000 000 000 000 000 000 001   |
| z      | zepto                   | sextillionth  | 0.000 000 000 000 000 000 001       |
| a      | atto                    | quintillionth | 0.000 000 000 000 000 001           |
| f      | femto                   | quadrillionth | 0.000 000 000 000 001               |
| p      | pico                    | trillionth    | 0.000 000 000 001                   |
| n      | nano                    | billionth     | 0.000 000 001                       |
| μ(/u)  | micro                   | millionth     | 0.000 001                           |
| m      | milli                   | thousandth    | 0.001                               |
| c      | centi                   | hundredth     | 0.01                                |
| d      | deci                    | tenth         | 0.1                                 |
|        | one                     | one           | 1                                   |
| da     | deca                    | ten           | 10                                  |
| h      | hecto                   | hundred       | 100                                 |
| k(/K)  | kilo                    | thousand      | 1000                                |
| M      | mega                    | million       | 1000 000                            |
| G      | giga                    | billion       | 1000 000 000                        |
| T      | tera                    | trillion      | 1000 000 000 000                    |
| P      | peta                    | quadrillion   | 1000 000 000 000 000                |
| E      | exa                     | quintillion   | 1000 000 000 000 000 000            |
| Z      | zetta                   | sextillion    | 1000 000 000 000 000 000 000        |
| Y      | yotta                   | septillion    | 1000 000 000 000 000 000 000 000    |
| 'auto' | Auto match (best match) | -             | *                                   |

The default used by the filter is `auto`.

#### Examples

```Twig
{{ 1|SI('z') }}
{# 1,000,000,000,000,000,000,000z #}

{{ '1337e0'|SI }}
{# 1K #}

{{ 4.2|SI('μ') }}
{# 4,200,000μ #}

{{ '-8123456'|SI('', '%number% %symbol%', 2, ',', '.') }}
{# -8.123.456,00 #}

{{ 1500000000000000000000000|SI('Y', '%number% <span>%symbol%</span>', 2, ',', '')|raw }}
{# 1,50 <span>Y</span> #}

```

The filter uses the number formatting set on the `Core` extension of Twig. The output can be customized even more by passing a `format`.

### UpperFirstFilter
###### GeckoPackages\Twig\Filters\UpperFirstFilter
Uppercase the first character of a string. For multi byte character support the filter will use `mbstring` (http://php.net/manual/en/book.mbstring.php)

#### Examples

```Twig

{{ 'hello world!'|upperFirst }}
{# Hello world! #}

{{ 'čůrá Test'|upperFirst  }}
{# Čůrá Test #}

```

### UpperRomanFilter
###### GeckoPackages\Twig\Filters\UpperRomanFilter
Uppercase Roman numerals in a string.
For details about the supported `modes` see the `Lower Roman` filter.

The default mode is `strict`.

#### Examples

```Twig

{{ 'a vi b'|upperRoman }}
{# a VI b #}

{{ 'mcmliv. chapter sub xi not XiCa'|upperRoman }}
{# MCMLIV. chapter sub XI not XiCa #}


```


## Tests

### NumericTest
###### GeckoPackages\Twig\Tests\NumericTest
Test if a given value is `numeric`.
The test will return false for hexadecimal strings as this will be the default behaviour in PHP 7.
(http://php.net/manual/en/function.is-numeric.php)

#### Examples

```Twig

{{ 12 is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '-1.3' is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '0x539' is not numeric ? 'Hex. is not numeric' : 'N'}}
{# Hex. is not numeric #}

```


### License

The project is released under the MIT license, see the LICENSE file.
