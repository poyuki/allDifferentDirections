<?php

namespace AllDifferentDirections\Tests;

use AllDifferentDirections;
use PHPUnit\Framework\TestCase;

class AllDifferentDirectionsTest extends TestCase
{
    protected $input=__DIR__.'/../../resources/sample.in';
    protected $output=__DIR__.'/../../resources/sample.ans';

    public function testMain()
    {
        $inputResource=fopen($this->input, 'rb+');
        $differentDirections = AllDifferentDirections\DifferentDirections::buildDirectionsCasesFromInput($inputResource);
        fclose($inputResource);
        $output=$differentDirections->getOutput();
        $this->assertEquals("97.1547 40.2334 7.63097\n30.0000 45.0000 0.00000\n",$output);
    }
}
