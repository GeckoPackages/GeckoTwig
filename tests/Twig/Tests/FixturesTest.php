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
 * Test runs the fixture '*.test' files found in '/Fixtures'.
 *
 * It also tests that there is a test file for each filter in the project.
 *
 * @author SpacePossum
 *
 * @internal
 */
final class FixturesTest extends \Twig_Test_IntegrationTestCase
{
    use TwigTestTrait;

    /**
     * {@inheritdoc}
     */
    public function getTwigFilters()
    {
        return $this->getTwigAddOns('Filters');
    }

    /**
     * {@inheritdoc}
     */
    public function getTwigTests()
    {
        return $this->getTwigAddOns('Tests');
    }

    /**
     * {@inheritdoc}
     */
    protected function getFixturesDir()
    {
        return __DIR__.'/Fixtures';
    }
}
