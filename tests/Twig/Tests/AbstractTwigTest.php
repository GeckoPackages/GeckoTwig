<?php

abstract class AbstractTwigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return Twig_LoaderInterface
     */
    protected function getLoaderMock()
    {
        return $this->getMockBuilder('Twig_LoaderInterface')->getMock();
    }

    protected function getEnvironment()
    {
        return new Twig_Environment($this->getLoaderMock());
    }
}
