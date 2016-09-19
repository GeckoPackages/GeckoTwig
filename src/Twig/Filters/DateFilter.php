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

class DateFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            'date',
            function (Twig_Environment $env, $date, $format = null, $timezone = null) {
                if (empty($date) && !is_array($date)) {
                    return '';
                }

                return twig_date_format_filter($env, $date, $format, $timezone);
            },
            ['needs_environment' => true]
        );
    }
}
