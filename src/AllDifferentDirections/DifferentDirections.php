<?php

namespace AllDifferentDirections;

class DifferentDirections
{
    /* @var DirectionsCase[] */
    public $directionsCases = [];

    private function __construct()
    {
    }

    /**
     * @param resource $input
     * @return DifferentDirections
     * @throws \Exception
     */
    public static function buildDirectionsCasesFromInput($input): DifferentDirections
    {
        $differentDirections = new static();
        while (($row = fgets($input)) !== false) {
            $caseLength = (int)$row;
            if ($caseLength === 0) {
                break;
            }
            $directionRows=[];
            for ($i = 0; $i < $caseLength; $i++) {
               $directionRows[]=fgets($input);
            }
            $directionsCase = DirectionsCase::buildDirectionCase($directionRows);
            $differentDirections->addDirectionsCase($directionsCase);
        }
        return $differentDirections;
    }

    /**
     * @param DirectionsCase $directionsCase
     */
    public function addDirectionsCase(DirectionsCase $directionsCase): void
    {
        $this->directionsCases[] = $directionsCase;
    }

    /**
     * @return DirectionsCase[]
     */
    public function getDirectionsCases(): array
    {
        return $this->directionsCases;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return array_reduce($this->getDirectionsCases(), function ($prev, $case) {
            return "$prev$case\n";
        }, '');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOutput();
    }
}