<?php

declare(strict_types=1);

namespace AllDifferentDirections;

use Exception;

class DifferentDirections
{
    /**
     * @var array<DirectionsCase>
     */
    public array $directionsCases = [];

    private function __construct()
    {
    }

    /**
     * @param resource $input
     * @return DifferentDirections
     * @throws Exception
     */
    public static function buildDirectionsCasesFromInput($input): DifferentDirections
    {
        $differentDirections = new static();
        while (($row = fgets($input)) !== false) {
            $caseLength = (int)$row;
            if ($caseLength === 0) {
                break;
            }
            $directionRows = [];
            for ($i = 0; $i < $caseLength; $i++) {
                $directionRows[] = fgets($input);
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
        return array_reduce($this->getDirectionsCases(), static fn($prev, $case) => $prev . $case . PHP_EOL, '');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getOutput();
    }
}
