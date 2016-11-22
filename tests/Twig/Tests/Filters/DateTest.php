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
final class DateTest extends AbstractFilterTest
{
    /**
     * Test the overloading of the date filter from the Twig core works.
     *
     * @param string $expected
     * @param array  $dates
     * @param bool   $addFilter
     *
     * @dataProvider provideDateReplacementCases
     */
    public function testDateReplacement($expected, array $dates, $addFilter)
    {
        $templateName = 'index.html';
        // add some trivial stuff at the end of the template to bust the Twig 'caching'
        $template = sprintf('[{{ test0|date("m/d/Y") }}][{{ test1|date("m/d/Y") }}] %s', $addFilter ? 'T' : 'F');

        $loader = new Twig_Loader_Array([$templateName => $template]);

        $env = new Twig_Environment($loader, ['cache' => false]);
        if ($addFilter) {
            $filter = $this->getFilter();
            $env->addFilter($filter);
        }

        $this->assertSame($expected, $env->render($templateName, ['test0' => $dates[0], 'test1' => $dates[1]]));
    }

    public function provideDateReplacementCases()
    {
        return [
            [
                sprintf('[%s][09/19/2016] F', date('m/d/Y')),
                [null, 1474293289],
                false,
            ],
            [
                '[][09/19/2016] T',
                [null, 1474293289],
                true,
            ],
        ];
    }
}
