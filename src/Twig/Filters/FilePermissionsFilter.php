<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace GeckoPackages\Twig\Filters;

/**
 * @api
 *
 * @author SpacePossum
 */
class FilePermissionsFilter extends \Twig_Filter
{
    public function __construct()
    {
        parent::__construct(
            'filePermissions',
            function ($string) {
                if (is_string($string)) {
                    if (ctype_digit($string)) {
                        $permissions = octdec($string);
                    } elseif (is_link($string)) {
                        $permissions = lstat($string)['mode'];
                    } elseif (file_exists($string)) {
                        $permissions = fileperms($string);
                    } else {
                        throw new \Twig_Error_Runtime(sprintf('Cannot determine permissions for "%s".', $string));
                    }
                } else {
                    $permissions = octdec($string);
                }

                if (($permissions & 0xC000) === 0xC000) {       // Socket
                    $info = 's';
                } elseif (($permissions & 0xA000) === 0xA000) { // Symbolic Link
                    $info = 'l';
                } elseif (($permissions & 0x8000) === 0x8000) { // Regular
                    $info = '-';
                } elseif (($permissions & 0x6000) === 0x6000) { // Block special
                    $info = 'b';
                } elseif (($permissions & 0x4000) === 0x4000) { // Directory
                    $info = 'd';
                } elseif (($permissions & 0x2000) === 0x2000) { // Character special
                    $info = 'c';
                } elseif (($permissions & 0x1000) === 0x1000) { // FIFO pipe
                    $info = 'p';
                } else { // Unknown
                    $info = 'u';
                }

                // Owner
                $info .= (($permissions & 0x0100) ? 'r' : '-');
                $info .= (($permissions & 0x0080) ? 'w' : '-');
                $info .= (($permissions & 0x0040) ?
                    (($permissions & 0x0800) ? 's' : 'x') :
                    (($permissions & 0x0800) ? 'S' : '-'));

                // Group
                $info .= (($permissions & 0x0020) ? 'r' : '-');
                $info .= (($permissions & 0x0010) ? 'w' : '-');
                $info .= (($permissions & 0x0008) ?
                    (($permissions & 0x0400) ? 's' : 'x') :
                    (($permissions & 0x0400) ? 'S' : '-'));

                // World
                $info .= (($permissions & 0x0004) ? 'r' : '-');
                $info .= (($permissions & 0x0002) ? 'w' : '-');
                $info .= (($permissions & 0x0001) ?
                    (($permissions & 0x0200) ? 't' : 'x') :
                    (($permissions & 0x0200) ? 'T' : '-'));

                return $info;
            }
            // array $options, 'is_safe' => false: since the given $string which might need escaping is returned.
        );
    }
}
