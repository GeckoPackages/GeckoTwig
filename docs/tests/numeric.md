### Numeric

Test given value is numeric (behaviour like PHP 7 `is_numeric`).

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
