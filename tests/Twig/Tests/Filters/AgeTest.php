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
final class AgeTest extends AbstractFilterTest
{
    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Accuracy must be string, got NULL\#.$#
     */
    public function testFilterInvalidAccType()
    {
        $this->callFilter($this->getEnvironment(), time(), null);
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Accuracy must be any of \"y, d, h, i, s\", got "invalid".$#
     */
    public function testFilterInvalidAccValue()
    {
        $this->callFilter($this->getEnvironment(), time(), 'invalid');
    }

    /**
     * @param int    $expected
     * @param string $acc      @see AgeFilter
     * @param string $input    Input for \DateTime constructor
     *
     * @dataProvider provideCases
     */
    public function testFilter($expected, $acc, $input)
    {
        $this->assertSame($expected, $this->callFilter($this->getEnvironment(), new \DateTime($input), $acc));
    }

    public function provideCases()
    {
        return [
            [3, 'h', '-180 minutes'],
            [180, 'i', '-180 minutes'],
            [180 * 60, 's', '-180 minutes'],
        ];
    }
}
