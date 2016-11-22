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
final class FilePermissionsTest extends AbstractFilterTest
{
    /**
     * @expectedException Twig_Error_Runtime
     * @expectedExceptionMessageRegExp #^Cannot determine permissions for "invalid".$#
     */
    public function testFileNotExists()
    {
        $filter = $this->getFilter();
        $call = $filter->getCallable();
        $call('invalid');
    }

    public function testSymLink()
    {
        $symLink = $this->getAssetsDir().'test_link';
        if (!file_exists($symLink)) {
            symlink($this->getAssetsDir().'test_file_link_target.txt', $symLink); // make symlink
        }

        $filter = $this->getFilter();
        $toCall = $filter->getCallable();
        $result = $toCall($symLink);
        unlink($symLink);
        $this->assertSame('lrwxrwxrwx', $result);
    }
}
