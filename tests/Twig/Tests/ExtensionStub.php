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
 * Extension stub for using the Twig fixture test.
 *
 * A stub holding all filters in the project for testing.
 * Prior to Twig 1.x there was no way to use the integration (fixtures) test
 * using custom filters without an extension class.
 *
 * @author SpacePossum
 *
 * @internal
 */
final class ExtensionStub extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return $this->getTwigAddOns('Filters');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'GeckoPackages Extension Test Stub';
    }

    /**
     * {@inheritdoc}
     */
    public function getTests()
    {
        return $this->getTwigAddOns('Tests');
    }

    private function getTwigAddOns($type)
    {
        $addOn = [];
        $addOnDir = new DirectoryIterator(__DIR__.'/../../../src/Twig/'.$type);
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
