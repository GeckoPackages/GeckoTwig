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
final class SITest extends AbstractFilterTest
{
    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported symbol "X".$#
     */
    public function testInvalidSymbol1()
    {
        $this->callFilter($this->getEnvironment(), 1, 'X');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported symbol "XYZ".$#
     */
    public function testInvalidSymbol2()
    {
        $this->callFilter($this->getEnvironment(), 2, 'XYZ');
    }

    public function testRounding()
    {
        $result = $this->callFilter(
            $this->getEnvironment(),
            0.0009999999999999999,
            'auto',
            '%number% %symbol%',
            16,
            ',',
            ''
        );
        $this->assertInternalType('string', $result);
        $this->assertStringStartsWith('999,9999999999', $result);
        $this->assertStringEndsWith(' u', $result);
    }
}
