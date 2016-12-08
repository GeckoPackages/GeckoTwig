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
final class BytesTest extends AbstractFilterTest
{
    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported symbol 'c'.$#
     */
    public function testFilterErrorSymbol1()
    {
        $this->callFilter($this->getEnvironment(), 1, 'c');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Binary symbol must be end with either 'b' or 'B', got "MiK".$#
     */
    public function testFilterSymbol2()
    {
        $this->callFilter($this->getEnvironment(), 1, 'MiK');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Symbol must start with 'k', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', or 'Y', got "xiB".$#
     */
    public function testFilterSymbol3()
    {
        $this->callFilter($this->getEnvironment(), 1, 'xiB');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Unsupported symbol "__invalid__".$#
     */
    public function testFilterSymbol4()
    {
        $this->callFilter($this->getEnvironment(), 1, '__invalid__');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Symbol must be binary \(b|B\[x\]\) or SI and must end with either 'b' or 'B', got "bti".$#
     */
    public function testFilterSymbol5()
    {
        $this->callFilter($this->getEnvironment(), 1, 'bti');
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Binary symbol must be end with either 'b' or 'B', got "bi".$#
     */
    public function testFilterSymbol6()
    {
        $this->callFilter($this->getEnvironment(), 1, 'bi');
    }
}
