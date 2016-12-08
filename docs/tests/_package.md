You can add any of the tests to the Twig environment.
Example:

```php
/** @var Twig_Environment $env */
$env->addTest(new \GeckoPackages\Twig\Tests\NumericTest());
```
