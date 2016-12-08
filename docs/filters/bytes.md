### Bytes

Formats a number of bytes with binary or SI prefix multiple, either automatically or by given symbol.

Formats a number of bytes to a specific SI or binary unit or in a auto (best match) way.
Specific units of IEC 60027-2 A.2 (1024 based [binary prefix](https://en.wikipedia.org/wiki/Binary_prefix)) and SI (1000 based [SI prefix](https://en.wikipedia.org/wiki/Metric_prefix#List_of_SI_prefixes)) are supported.

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
