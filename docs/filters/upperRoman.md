### Upper Roman

Uppercase Roman numerals in a string.

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
