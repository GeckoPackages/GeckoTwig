### Upper First

Uppercase the first character of a string.

Uppercase the first character of a string. For multi byte character support the filter will use `mbstring` (http://php.net/manual/en/book.mbstring.php)

#### Examples

```Twig

{{ 'hello world!'|upperFirst }}
{# Hello world! #}

{{ 'čůrá Test'|upperFirst  }}
{# Čůrá Test #}

```
