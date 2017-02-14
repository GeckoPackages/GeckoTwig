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

use GeckoPackages\Twig\Text\RomanNumeralsTrait;

/**
 * Lowercase Roman numerals.
 *
 * For 'matchMode' and other details @see RomanNumeralsTrait
 *
 * @api
 *
 * @author SpacePossum
 */
class LowerRomanFilter extends \Twig_Filter
{
    use RomanNumeralsTrait;

    public function __construct()
    {
        parent::__construct(
            'lowerRoman',
            /**
             * @param string $string
             * @param string $matchMode
             *
             * @return string
             */
            function ($string, $matchMode = 'strict') {
                return $this->numeralRomanMatchCallBack(
                    $string,
                    $matchMode,
                    function (array $matches) {
                        if (empty($matches[1])) {
                            return $matches[1];
                        }

                        return strtolower($matches[1]);
                    }
                );
            }
            // array $options, 'is_safe' => false: since the given $string which might need escaping is returned.
        );
    }
}
