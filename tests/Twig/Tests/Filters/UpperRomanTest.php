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
final class UpperRomanTest extends AbstractFilterTest
{
    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode string\#invalid.$#
     */
    public function testInvalidMatchModeString()
    {
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call('XX', 'invalid');
    }

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode stdClass.$#
     */
    public function testInvalidMatchModeObject()
    {
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call('XX', new \stdClass());
    }

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Invalid input, expected string got \"stdClass\".$#
     */
    public function testInvalidInputObject()
    {
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call(new \stdClass(), 'strict');
    }
}
