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

    /**
     * @param string $type
     *
     * @return array
     */
    private function getTwigAddOns($type)
    {
        $dir = __DIR__.'/../../../src/Twig/'.$type;
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('No directory known for type "%s".', $type));
        }

        $addOn = [];
        $addOnDir = new DirectoryIterator($dir);
        foreach ($addOnDir as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isDir()) {
                throw new UnexpectedValueException(sprintf('No directory was expected, got "%s".', $file->getPathname()));
            }

            $class = $file->getFilename();
            $class = sprintf('GeckoPackages\\Twig\\%s\\%s', $type, substr($class, 0, -4));
            if (!class_exists($class)) {
                throw new UnexpectedValueException(sprintf('%s class "%s" not found.', $type, $class));
            }

            $addOn[] = new $class();
        }

        if (count($addOn) < 1) {
            throw new UnexpectedValueException(sprintf('No Twig add on found to test in directory "%s".', $addOnDir));
        }

        return $addOn;
    }
}
