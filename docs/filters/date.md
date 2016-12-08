### Date

Replacement for the date filter of Twig, returns an empty string if the date is `empty()`.

Replacement of the date filter provided by [Twig](http://twig.sensiolabs.org/doc/filters/date.html). Returns an empty string `""` if the give date to format is `empty()` (and not an `array`).
If it is not the method returns the value as provided by the default date filter of Twig.

#### Examples

```Twig
zero int     [{{ 0|date }}]
{# zero int     [] #}
zero float   [{{ 0.0|date }}]
{# zero float   [] #}
zero string  [{{ '0'|date }}]
{# zero string  [] #}
empty string [{{ ''|date }}]
{# empty string [] #}
null value   [{{ null|date }}]
{# null value   [] #}
false value  [{{ false|date }}]
{# false value  [] #}
timestamp    [{{ timestamp|date('m/d/Y') }}]
{# timestamp    [09/19/2016] #}
```
