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
final class UpperFirstTest extends AbstractFilterTest
{
    public function testUpperFirst()
    {
        $this->callFilter($this->getEnvironment(), null);
    }

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Invalid input, expected string got \"stdClass\".$#
     */
    public function testUpperFirstInvalidInput()
    {
        $this->callFilter($this->getEnvironment(), new \stdClass());
    }
}
