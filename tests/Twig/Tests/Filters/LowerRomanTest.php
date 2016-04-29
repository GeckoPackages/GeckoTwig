<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

class LowerRomanTest extends AbstractFilterTest
{
    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode "invalid".$#
     */
    public function testMatchModeInvalid()
    {
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call('invalid', 'invalid');
    }
}
