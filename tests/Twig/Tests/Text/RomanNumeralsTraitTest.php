<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use GeckoPackages\Twig\Text\RomanNumeralsTrait;

/**
 * @author SpacePossum
 *
 * @internal
 */
final class RomanNumeralsTraitTest extends \PHPUnit_Framework_TestCase
{
    use RomanNumeralsTrait;

    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported match mode "__invalid__".$#
     */
    public function testInvalid()
    {
        $this->numeralRomanMatchCallBack('xx', '__invalid__', function () {
        });
    }
}
