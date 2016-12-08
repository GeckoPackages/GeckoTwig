### Numeric

Test given value is numeric (behaviour like PHP 7).

Test if a given value is `numeric`.
The test will return false for hexadecimal strings as this is the behaviour of [`is_numeric`](https://secure.php.net/manual/en/function.is-numeric.php) on PHP 7.

#### Examples

```Twig

{{ 12 is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '-1.3' is numeric ? 'Yes' : 'No' }}
{# Yes #}

{{ '0x539' is not numeric ? 'Hex. is not numeric' : 'N'}}
{# Hex. is not numeric #}

```
