<?php

/*
 * This file is part of the GeckoPackages.
 *
 * (c) GeckoPackages https://github.com/GeckoPackages
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace GeckoPackages\Twig\Tests;

/**
 * Test if a given value is "numeric".
 *
 * @api
 *
 * @author SpacePossum
 */
class NumericTest extends \Twig_Test
{
    public function __construct()
    {
        parent::__construct(
            'numeric',
            null,
            ['node_class' => 'GeckoPackages\Twig\Tests\NumericTestNode']
        );
    }
}

final class NumericTestNode extends \Twig_Node_Expression_Test
{
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->raw('is_numeric(')->subcompile($this->getNode('node'))->raw(')');
    }
}
