### Age

Calculates the time difference (age) between a date and the current date.

Calculates and returns the time difference (age) between a date and the current date.

You use an accuracy:

| symbol | accuracy |
| ------ | -------- |
| y      | Year     |
| d      | Day      |
| h      | Hour     |
| i      | Minute   |
| s      | Seconds  |

The default is `y`. Symbols are case insensitive.

#### Examples

```Twig
{# today is new \DateTime() #}

{{ today|date_modify("-36 hours")|age('d') }} day.
{# 1.5 day. #}

{{ today|date_modify("180 minutes")|age('h') }} hours.
{# -3 hours. note the "minus" "#}

{{ today|date_modify("-180 minutes")|age('i') }} minutes.
{# 180 minutes. #}

{{ today|date_modify("-180 minutes")|age('s') }} seconds.
{# 10800 seconds. #}

```

Pass a timezone as second argument to set for the date passed. \*<br/>
Pass a timezone as third argument for creating the current date. \*

<sub>* Pass `null` to use the default, `false` to leave unchanged.</sub>
