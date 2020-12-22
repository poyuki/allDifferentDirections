<?php

declare(strict_types=1);

namespace AllDifferentDirections;

use RuntimeException;

class DirectionsCase
{
    /**
     * @var array
     */
    public array $directions = [];

    private function __construct()
    {
    }

    /**
     * @param DirectionPoint $direction
     */
    public function addDirection(DirectionPoint $direction): void
    {
        $this->directions[] = $direction;
    }

    /**
     * @param array $directionRows
     * @return DirectionsCase
     * @throws RuntimeException
     */
    public static function buildDirectionCase(array $directionRows): DirectionsCase
    {
        $directionCase = new static();
        foreach ($directionRows as $directionRow) {
            $directionArray = explode(' ', $directionRow);
            $point = new DirectionPoint();
            $point->setX(current($directionArray));
            $point->setY(next($directionArray));
            $angle = 0.0;
            while (($directive = next($directionArray)) !== false) {
                switch ($directive) {
                    case DirectionDirectives::START:
                        $angle = (float)next($directionArray);
                        break;
                    case DirectionDirectives::TURN:
                        $angle += (float)next($directionArray);
                        break;
                    case DirectionDirectives::WALK:
                        $point->calculateNewDirectionPoint((float)next($directionArray), $angle);
                        break;
                    default:
                        throw new RuntimeException('Unknown directive');
                }
            }
            $directionCase->addDirection($point);
        }
        return $directionCase;
    }

    /**
     * @return DirectionPoint[]
     */
    public function getDirections(): array
    {
        return $this->directions;
    }

    /**
     * @return DirectionPoint
     */
    public function calculateAndGetAvgDirection(): DirectionPoint
    {
        $direction_x_sum = 0;
        $direction_y_sum = 0;
        foreach ($this->directions as $direction) {
            $direction_x_sum += $direction->getX();
            $direction_y_sum += $direction->getY();
        }
        $directionLength = count($this->getDirections());
        $direction_x_avg = $direction_x_sum / $directionLength;
        $direction_y_avg = $direction_y_sum / $directionLength;

        return DirectionPoint::buildWithCoordinate($direction_x_avg, $direction_y_avg);
    }

    /**
     * @param DirectionPoint|null $avgDirectionPoint
     * @return int|mixed
     */
    public function calculateAndGetWorstDistanceBetweenAvgAndDirections(DirectionPoint $avgDirectionPoint = null): int
    {
        $worstDistance = 0;
        if (!isset($avgDirectionPoint)) {
            $avgDirectionPoint = $this->calculateAndGetAvgDirection();
        }
        foreach ($this->getDirections() as $direction) {
            $worstDistance = max($worstDistance, hypot($avgDirectionPoint->getX() - $direction->getX(), $avgDirectionPoint->getY() - $direction->getY()));
        }

        return $worstDistance;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        $avgDirectionPoint = $this->calculateAndGetAvgDirection();
        $worstDistance = $this->calculateAndGetWorstDistanceBetweenAvgAndDirections($avgDirectionPoint);
        $worstDistanceFormatted = number_format($worstDistance, 5);

        return "$avgDirectionPoint $worstDistanceFormatted";
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getOutput();
    }
}
