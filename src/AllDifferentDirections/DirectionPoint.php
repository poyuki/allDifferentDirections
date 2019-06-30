<?php


namespace AllDifferentDirections;


class DirectionPoint
{
    /* @var float */
    private $x;
    /* @var float */
    private $y;


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
    public function setX($x): void
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
    public function setY($y): void
    {
        $this->y = $y;
    }

    public function __toString()
    {
        $x_formatted=number_format($this->x,4);
        $y_formatted=number_format($this->y,4);
        return "{$x_formatted} {$y_formatted}";
    }
}