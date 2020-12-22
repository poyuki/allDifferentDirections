<?php

declare(strict_types=1);

namespace AllDifferentDirections;

class DirectionPoint
{
    private float $x;
    private float $y;


    /**
     * @param float $x
     * @param float $y
     * @return DirectionPoint
     */
    public static function buildWithCoordinate(float $x, float $y): DirectionPoint
    {
        $point = new static();
        $point->x = $x;
        $point->y = $y;
        return $point;
    }

    /**
     * @param float $distance
     * @param float $angle
     */
    public function calculateNewDirectionPoint(float $distance, float $angle): void
    {
        $this->x += $distance * cos($angle * M_PI / 180);
        $this->y += $distance * sin($angle * M_PI / 180);
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY(float $y): void
    {
        $this->y = $y;
    }

    public function __toString(): string
    {
        $x_formatted=number_format($this->x,4);
        $y_formatted=number_format($this->y,4);
        return "{$x_formatted} {$y_formatted}";
    }
}
