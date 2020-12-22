<?php

declare(strict_types=1);

namespace AllDifferentDirections\Tests;

use AllDifferentDirections;
use PHPUnit\Framework\TestCase;

class AllDifferentDirectionsTest extends TestCase
{
    protected string $input = __DIR__ . '/../../resources/sample.in';
    protected string $output = __DIR__ . '/../../resources/sample.ans';

    public function testMain(): void
    {
        $inputResource = fopen($this->input, 'rb+');
        $differentDirections = AllDifferentDirections\DifferentDirections::buildDirectionsCasesFromInput($inputResource);
        fclose($inputResource);
        $output = $differentDirections->getOutput();

        self::assertEquals("97.1547 40.2334 7.63097\n30.0000 45.0000 0.00000\n", $output);
    }
}
