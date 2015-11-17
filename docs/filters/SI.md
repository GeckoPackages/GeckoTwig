### SI

Formats a number with a SI symbol, either automatically or by given symbol.

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
