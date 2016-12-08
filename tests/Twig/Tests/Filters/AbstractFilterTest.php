<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * @author SpacePossum
 *
 * @internal
 */
abstract class AbstractFilterTest extends AbstractTwigTest
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

    /**
     * To be replace with ... on PHP 5.6+ @see https://secure.php.net/manual/en/functions.arguments.php#functions.variable-arg-list.new
     */
    protected function callFilter()
    {
        $filter = $this->getFilter();

        return call_user_func_array($filter->getCallable(), func_get_args());
    }
}
