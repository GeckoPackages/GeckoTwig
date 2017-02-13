<?php

declare(strict_types=1);

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
final class LowerRomanTest extends AbstractFilterTest
{
    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode string\#invalid.$#
     */
    public function testMatchModeInvalid()
    {
        $this->callFilter('IV', 'invalid');
    }
}
