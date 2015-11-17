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

use Twig_Environment;

/**
 * Uppercase first character of a string.
 *
 * @api
 *
 * @author SpacePossum
 */
class UpperFirstFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            'upperFirst',
            function (Twig_Environment $env, $string) {
                if (function_exists('mb_get_info') && null !== $charset = $env->getCharset()) {
                    return mb_strtoupper(mb_substr($string, 0, 1, $charset), $charset).mb_substr($string, 1, mb_strlen($string, $charset), $charset);
                }

                return ucfirst($string);
            },
            array('needs_environment' => true) // 'is_safe' => false: since the given $format which might need escaping is returned.
        );
    }
}
