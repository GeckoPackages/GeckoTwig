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
        $this->callFilter('XX', 'invalid');
    }

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode stdClass.$#
     */
    public function testInvalidMatchModeObject()
    {
        $this->callFilter('XX', new \stdClass());
    }

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Invalid input, expected string got \"stdClass\".$#
     */
    public function testInvalidInputObject()
    {
        $this->callFilter(new \stdClass(), 'strict');
    }
}
