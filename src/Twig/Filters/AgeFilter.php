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
 * Calculate the time diff (age) between a date and the current date.
 *
 * @api
 *
 * @author SpacePossum
 */
class AgeFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            'age',
            /**
             * @param Twig_Environment                         $env
             * @param \DateTime|\DateTimeInterface|string|null $date
             * @param string                                   $acc          accuracy; any of 'y, d, h, i, s', default 'y'
             * @param \DateTimeZone|string|null|false          $timezoneDate timezone of date passed, null to use the default, false to leave unchanged
             * @param \DateTimeZone|string|null|false          $timezoneNow  timezone of the current date, null to use the default, false to leave unchanged
             *
             * @return string
             */
            function (Twig_Environment $env, $date, $acc = 'y', $timezoneDate = null, $timezoneNow = null) {
                $now = time();

                if (!is_string($acc)) {
                    throw new \Twig_Error_Runtime(sprintf(
                        'Accuracy must be string, got %s.',
                        is_object($acc) ? get_class($acc) : gettype($acc).(is_resource($acc) ? '' : '#'.$acc)
                    ));
                }

                $date = twig_date_converter($env, $date, $timezoneDate);
                $now = twig_date_converter($env, $now, $timezoneNow);
                $diff = $now->diff($date, false);

                switch (strtolower($acc)) {
                    case 'y':
                        $v =
                            $diff->y
                            + ($diff->m / 12)
                            + (($diff->d + (($diff->h + (($diff->i + ($diff->s / 60)) / 60)) / 24)) / 365)
                        ;

                        break;
                    // case 'm' is not supported by design
                    case 'd':
                        $v =
                            (int) $diff->format('%a')
                            + (($diff->h + (($diff->i + ($diff->s / 60)) / 60)) / 24)
                        ;

                        break;
                    case 'h':
                        $v =
                            24 * (int) $diff->format('%a')
                            + $diff->h
                            + (($diff->i + ($diff->s / 60)) / 60)
                        ;

                        break;
                    case 'i':
                        $v =
                            60 * 24 * (int) $diff->format('%a')
                            + 60 * $diff->h
                            + $diff->i
                            + ($diff->s / 60)
                        ;

                        break;
                    case 's':
                        return (int) $now->format('U') - (int) $date->format('U');
                    default:
                        throw new \Twig_Error_Runtime(sprintf('Accuracy must be any of "y, d, h, i, s", got "%s".', $acc));
                }

                // (int) cast for HHVM =< 3.9.10
                // https://github.com/facebook/hhvm/pull/6134 / https://github.com/facebook/hhvm/issues/5537
                return 1 === (int) $diff->invert ? $v : -1 * $v;
            },
            ['needs_environment' => true]
        );
    }
}
