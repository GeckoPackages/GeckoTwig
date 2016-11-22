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
final class CompletenessTest extends \PHPUnit_Framework_TestCase
{
    use TwigTestTrait;

    /**
     * Test the class name of a filter matches the name of the filter itself.
     *
     * @param Twig_SimpleFilter $filter
     *
     * @dataProvider provideFilters
     */
    public function testFilterClassNaming(Twig_SimpleFilter $filter)
    {
        $this->classNamingTest(ucfirst($filter->getName()).'Filter', $filter);
    }

    /**
     * Test there is a doc file for each filter.
     *
     * @param Twig_SimpleFilter $filter
     *
     * @dataProvider provideFilters
     */
    public function testFilterHasDocFile(Twig_SimpleFilter $filter)
    {
        $file = $this->getDocDir().'filters/'.$filter->getName().'.md';
        $this->assertFileExists($file, sprintf('Missing documentation file for Filter "%s".', $filter->getName()));
        $this->docFormatTest($file);
    }

    /**
     * Test there is a fixture test file for each filter.
     *
     * @param Twig_SimpleFilter $filter
     *
     * @dataProvider provideFilters
     */
    public function testFilterHasFixtureTests(Twig_SimpleFilter $filter)
    {
        $file = __DIR__.'/Fixtures/filters/'.$filter->getName().'.test';
        $this->assertFileExists($file, sprintf('Missing fixture test file for Filter "%s".', $filter->getName()));
    }

    /**
     * Test there is a PHPUnit test file for each filter.
     *
     * @param Twig_SimpleFilter $filter
     *
     * @dataProvider provideFilters
     */
    public function testFilterHasPHPUnitTests(Twig_SimpleFilter $filter)
    {
        $file = __DIR__.'/Filters/'.ucfirst($filter->getName()).'Test.php';
        $this->assertFileExists($file, sprintf('Missing PHPUnit test for Filter "%s".', $filter->getName()));
    }

    public function provideFilters()
    {
        $filters = $this->getTwigAddOns('Filters');
        $exploded = [];
        /** @var Twig_SimpleFilter[] $filters */
        foreach ($filters as $filter) {
            $exploded[] = [$filter];
        }

        return $exploded;
    }

    /**
     * Test the class name of a test matches the name of the test itself.
     *
     * @param Twig_SimpleTest $test
     *
     * @dataProvider provideTests
     */
    public function testTestsClassNaming(Twig_SimpleTest $test)
    {
        $this->classNamingTest(ucfirst($test->getName()).'Test', $test);
    }

    /**
     * Test there is a doc file for each test.
     *
     * @param Twig_SimpleTest $test
     *
     * @dataProvider provideTests
     */
    public function testTestHasDocFile(Twig_SimpleTest $test)
    {
        $file = $this->getDocDir().'tests/'.$test->getName().'.md';
        $this->assertFileExists($file, sprintf('Missing documentation file for Test "%s".', $test->getName()));
        $this->docFormatTest($file);
    }

    /**
     * Test there is a fixture test file for each test.
     *
     * @param Twig_SimpleTest $test
     *
     * @dataProvider provideTests
     */
    public function testTestHasFixtureTests(Twig_SimpleTest $test)
    {
        $file = __DIR__.'/Fixtures/tests/'.$test->getName().'.test';
        $this->assertFileExists($file, sprintf('Missing fixture test file for Test "%s".', $test->getName()));
    }

    public function provideTests()
    {
        $tests = $this->getTwigAddOns('Tests');
        $exploded = [];
        /** @var Twig_SimpleTest[] $tests */
        foreach ($tests as $filter) {
            $exploded[] = [$filter];
        }

        return $exploded;
    }

    private function classNamingTest($expectedClassName, $object)
    {
        $className = get_class($object);
        $className = substr($className, strrpos($className, '\\') + 1);
        $this->assertSame($expectedClassName, $className);
    }

    private function docFormatTest($file)
    {
        $content = @file_get_contents($file);
        $this->assertNotFalse($content, sprintf('Failed to get content of "%s".', $file));
        $this->assertNotSame('', trim($content), sprintf('File may not be empty "%s".', $file));
    }

    private function getDocDir()
    {
        return realpath(__DIR__.'/../../../docs').'/';
    }
}
