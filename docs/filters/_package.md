You can add any of the filters to the Twig environment.
Example:

```php
/** @var Twig_Environment $env */
$env->addFilter(new \GeckoPackages\Twig\Filters\AgeFilter());
```
