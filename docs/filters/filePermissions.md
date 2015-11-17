### File Permissions

Formats file permissions in symbolic (UNIX) notation.

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
