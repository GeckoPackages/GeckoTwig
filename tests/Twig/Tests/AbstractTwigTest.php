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
abstract class AbstractTwigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Twig_LoaderInterface
     */
    protected function getLoaderMock()
    {
        return $this->getMockBuilder('Twig_LoaderInterface')->getMock();
    }

    /**
     * @return Twig_Environment new Twig_Environment with mocked loader set
     */
    protected function getEnvironment()
    {
        return new \Twig_Environment($this->getLoaderMock());
    }
}
