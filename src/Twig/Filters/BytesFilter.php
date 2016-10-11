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
 * Formats a number of bytes with binary or SI prefix multiple.
 *
 * Formats to a specific unit or in a auto (best match) way.
 * Specific units of IEC 60027-2 A.2 (1024 based) or SI (1000 based) are supported.
 *
 * Symbols supported:
 *
 * binary      | SI
 * ------------+---------------+----
 * b  (bit)    | b     (bit)   |
 * B  (byte)   | B     (byte)  |
 * Ki (kibi)   | k(/K) (kilo)  | *
 * Mi (mebi)   | M     (mega)  | *
 * Gi (gibi)   | G     (giga)  | *
 * Ti (tebi)   | T     (tera)  | *
 * Pi (pebi)   | P     (peta)  | *
 * Ei (exbi)   | E     (exa)   | *
 * Zi (zebi)   | Z     (zetta) | *
 * Yi (yobi)   | Y     (yotta) | *
 * ------------+---------------+----
 * 'auto,bin'  | 'auto,SI'     | **
 *
 *  * Symbol must be followed by a character to indicate either bit ('b') or byte ('B').
 *    For example: 'Mib', 'kb',
 * ** Auto match (best match) format in bytes.
 *
 * Note: Prefixes 'deca', 'hecto' and (absolute) numbers above Y(i) * 1000 (1024) are not supported.
 *
 * More details:
 * https://en.wikipedia.org/wiki/Binary_prefix
 * https://en.wikipedia.org/wiki/Metric_prefix#List_of_SI_prefixes
 *
 * @api
 *
 * @author SpacePossum
 */
class BytesFilter extends \Twig_SimpleFilter
{
    public function __construct()
    {
        parent::__construct(
            'bytes',
            /**
             * @param number $value
             * @param string $symbol any SI ('KB', 'Mb', ..) or binary symbol ('KiB', 'Kib', 'MiB', ..), or 'auto,SI', 'auto,bin', 'b' or 'B'
             * @param string $format
             *
             * @return string
             */
            function (Twig_Environment $env, $number, $symbol = 'auto,bin', $format = '%number%%symbol%', $decimal = null, $decimalPoint = null, $thousandSep = null) {
                $symbolLength = strlen($symbol);

                $symbolMag = [
                    'k' => 1, // kilo
                    'K' => 1, // "
                    'M' => 2, // mega
                    'G' => 3, // giga
                    'T' => 4, // tera
                    'P' => 5, // peta
                    'E' => 6, // exa
                    'Z' => 7, // zetta
                    'Y' => 8, // yotta
                ];

                if ($symbolLength === 1) {
                    if ('b' === $symbol) {
                        $number *= 8;
                    } elseif ('B' !== $symbol) {
                        throw new \Twig_Error_Runtime(sprintf('Unsupported symbol \'%s\'.', $symbol));
                    }
                } elseif ($symbolLength <= 3) {
                    // SI vs. bin.
                    switch ($symbol[1]) {
                        case 'i': { // Binary
                            if ($symbolLength < 3) {
                                throw new \Twig_Error_Runtime(sprintf('Binary symbol must be end with either \'b\' or \'B\', got "%s".', $symbol));
                            } elseif ('b' === $symbol[2]) { // binary| bit
                                $number *= 8;
                            } elseif ('B' !== $symbol[2]) { // binary| byte
                                throw new \Twig_Error_Runtime(sprintf('Binary symbol must be end with either \'b\' or \'B\', got "%s".', $symbol));
                            }

                            $magnitude = 1024;
                            break;
                        }
                        case 'b': { // SI | bit
                            $magnitude = 1000;
                            $number *= 8;
                            break;
                        }
                        case 'B': { // SI | byte
                            $magnitude = 1000;
                            break;
                        }
                        default: {
                            throw new \Twig_Error_Runtime(sprintf('Symbol must be binary (b|B[x]) or SI and must end with either \'b\' or \'B\', got "%s".', $symbol));
                        }
                    }

                    if (!array_key_exists($symbol[0], $symbolMag)) {
                        throw new \Twig_Error_Runtime(sprintf('Symbol must start with \'k\', \'K\', \'M\', \'G\', \'T\', \'P\', \'E\', \'Z\', or \'Y\', got "%s".', $symbol));
                    }

                    $number /= pow($magnitude, $symbolMag[$symbol[0]]); // ** on PHP 5.6
                } elseif ('auto,bin' === $symbol) {
                    if ($number < 1024 && $number > -1024) {
                        $symbol = 'B';
                    } else {
                        $negative = $number < 0;
                        $number = $negative ? abs($number) : $number;

                        // since it is not guaranteed that array() will set the pointer to the first element
                        reset($symbolMag);
                        $mag = 0;

                        while ($number >= 1023.9999999999 && $mag <= 8) { // large numbers rounding issues
                            ++$mag;
                            $number /= 1024; // $number >>= 10; doesn't work for large numbers (> PHP_INT_MAX) and looses the decimals
                            next($symbolMag);
                        }

                        if ($negative) {
                            $number *= -1;
                        }
                        $symbol = key($symbolMag).'iB';
                    }
                } elseif ('auto,SI' === $symbol) {
                    if ($number < 1000 && $number > -1000) {
                        $symbol = 'B';
                    } else {
                        $negative = $number < 0;
                        $number = $negative ? abs($number) : $number;

                        // since it is not guaranteed that array() will set the pointer to the first element
                        reset($symbolMag);
                        $mag = 0;
                        while ($number >= 1000 && $mag <= 8) {
                            ++$mag;
                            $number /= 1000;
                            next($symbolMag);
                        }

                        if ($negative) {
                            $number *= -1;
                        }

                        $symbol = key($symbolMag).'B';
                    }
                } else {
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

                return str_replace('%number%', $number, $format);
            },
            ['needs_environment' => true] // 'is_safe' => false: since the given $format which might need escaping is returned.
        );
    }
}
