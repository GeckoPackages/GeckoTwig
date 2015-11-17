### Lower Roman

Lowercase Roman numerals in a string.

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
