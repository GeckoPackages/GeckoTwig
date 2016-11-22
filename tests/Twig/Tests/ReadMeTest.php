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
final class ReadMeTest extends \PHPUnit_Framework_TestCase
{
    public function testReadMe()
    {
        $this->assertStringEqualsFile(__DIR__.'/../../../README.md', $this->generateReadMe());
    }

    public function generateReadMe()
    {
        require_once __DIR__.'/ReadMeGenerator.php';
        $generator = new ReadMeGenerator();

        return $generator->generateReadMe();
    }
}
