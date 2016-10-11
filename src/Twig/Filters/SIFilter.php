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
 * Formats a number with a SI symbol.
 *
 * Symbols supported:
 *
 * -------+-------------------------+---------------+-----------------------------------
 * y      | yocto                   | septillionth  | 0.000 000 000 000 000 000 000 001
 * z      | zepto                   | sextillionth  | 0.000 000 000 000 000 000 001
 * a      | atto                    | quintillionth | 0.000 000 000 000 000 001
 * f      | femto                   | quadrillionth | 0.000 000 000 000 001
 * p      | pico                    | trillionth    | 0.000 000 000 001
 * n      | nano                    | billionth     | 0.000 000 001
 * μ(/u)  | micro                   | millionth     | 0.000 001
 * m      | milli                   | thousandth    | 0.001
 * c      | centi                   | hundredth     | 0.01
 * d      | deci                    | tenth         | 0.1
 *        | one                     | one           | 1
 * da     | deca                    | ten           | 10
 * h      | hecto                   | hundred       | 100
 * k(/K)  | kilo                    | thousand      | 1000
 * M      | mega                    | million       | 1000 000
 * G      | giga                    | billion       | 1000 000 000
 * T      | tera                    | trillion      | 1000 000 000 000
 * P      | peta                    | quadrillion   | 1000 000 000 000 000
 * E      | exa                     | quintillion   | 1000 000 000 000 000 000
 * Z      | zetta                   | sextillion    | 1000 000 000 000 000 000 000
 * Y      | yotta                   | septillion    | 1000 000 000 000 000 000 000 000
 * -------+-------------------------+--------------------------------------------------
 * 'auto' | Auto match (best match) |
 *
 * More details:
 * https://en.wikipedia.org/wiki/Metric_prefix#List_of_SI_prefixes
 *
 * @api
 *
 * @author SpacePossum
 */
class SIFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            'SI',
            function (Twig_Environment $env, $number, $symbol = 'auto', $format = '%number%%symbol%', $decimal = null, $decimalPoint = null, $thousandSep = null) {
                $symbolMag = [
                    'y', 'z', 'a', 'f', 'p', 'n', 'u', 'μ', 'm', 'c', 'd',  // < 1 note: double 'u'/'μ'
                    'da', 'h', 'k', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y', // > 1 note: double 'k'/'K 'and two char. 'da'
                ];

                if (1 === strlen($symbol) || 'μ' === $symbol) {
                    $index = array_search($symbol, $symbolMag, true);
                    if (false === $index) {
                        throw new \Twig_Error_Runtime(sprintf('Unsupported symbol "%s".', $symbol));
                    }

                    if ($index > 10) {
                        // division
                        if ($index > 13) {
                            $index -= 3; // double 'k' correction
                            $pow = 1000;
                        } else {
                            $pow = 10;
                        }

                        $number /= pow($pow, $index - 10); // -10 includes the double 'u' correction
                    } else {
                        // multiply
                        if ($index > 8) {
                            $pow = 10;
                            $index -= 3; // includes the double 'u' correction
                        } else {
                            if ($index > 6) {
                                --$index; // double 'u' correction
                            }

                            $pow = 1000;
                        }

                        $number *= pow($pow, 8 - $index);
                    }
                } elseif ($symbol === 'da') {
                    $number /= 10;
                } elseif ($symbol === 'auto') {
                    $negative = $number < 0;
                    $number = $negative ? abs($number) : $number;

                    if (($number >= 1 && $number <= 10) || 0 === $number) {
                        $symbol = '';
                    } elseif ($number < 1) {
                        if ($number < 0.001) {
                            $mag = 8;
                            while ($number < 1 && $mag >= 0) {
                                --$mag; // first decrement is double 'u' correction
                                $number *= 1000;
                            }
                        } else {
                            $mag = 11;
                            while ($number < 1) {
                                --$mag;
                                $number *= 10;
                            }
                        }

                        $symbol = $symbolMag[$mag];
                    } else {
                        if ($number < 1000) {
                            $mag = 0;
                            while ($number >= 10) {
                                ++$mag;
                                $number /= 10;
                            }
                        } else {
                            $mag = 2;
                            while ($number >= 1000 && $mag <= 10) {
                                ++$mag;
                                $number /= 1000;
                            }
                        }

                        $mag += $mag > 2 ? 11 : 10;
                        $symbol = $symbolMag[$mag];
                    }

                    if ($negative) {
                        $number *= -1;
                    }
                } elseif ($symbol !== '') {
                    throw new \Twig_Error_Runtime(sprintf('Unsupported symbol "%s".', $symbol));
                }

                $defaults = $env->getExtension('Twig_Extension_Core')->getNumberFormat();
                if (null === $decimal) {
                    $decimal = $defaults[0];
                }

                if (null === $decimalPoint) {
                    $decimalPoint = $defaults[1];
                }

                if (null === $thousandSep) {
                    $thousandSep = $defaults[2];
                }

                $number = number_format((float) $number, $decimal, $decimalPoint, $thousandSep);
                $format = str_replace('%symbol%', $symbol, $format);
                if ('' === $symbol) {
                    $format = trim($format);
                }

                return str_replace('%number%', $number, $format);
            },
            ['needs_environment' => true] // 'is_safe' => false: since the given $format which might need escaping is returned.
        );
    }
}
