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
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call(new Twig_Environment($this->getLoaderMock()), null);
    }
}
