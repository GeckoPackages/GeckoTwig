<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

abstract class AbstractFilterTest extends \PHPUnit_Framework_TestCase
{
    use TwigTestTrait;

    /**
     * @return Twig_SimpleFilter
     */
    protected function getFilter()
    {
        $reflection = new \ReflectionClass($this);
        $class = 'GeckoPackages\\Twig\\Filters\\'.substr($reflection->getShortName(), 0, -4).'Filter';

        return new $class();
    }
}
