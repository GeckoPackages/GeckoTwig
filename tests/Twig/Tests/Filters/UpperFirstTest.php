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
final class UpperFirstTest extends AbstractFilterTest
{
    /**
     * @param string $expected
     * @param mixed  $input
     *
     * @dataProvider provideCases
     */
    public function testUpperFirst(string $expected, $input)
    {
        $this->assertSame($expected, $this->callFilter($this->getEnvironment(), $input));
    }

    public function provideCases()
    {
        return [
            ['', null],
            ['0', 0],
            ['1', 1],
            ['1.3', 1.3],
        ];
    }

    /**
     * @expectedException \Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Invalid input, expected string got \"stdClass\".$#
     */
    public function testUpperFirstInvalidInput()
    {
        $this->callFilter($this->getEnvironment(), new \stdClass());
    }
}
