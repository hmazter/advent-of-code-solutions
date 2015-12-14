<?php


class Reindeer
{

    private $movingSpeed;

    private $movingDuration;

    private $stillDuration;

    private $totalLength = 0;

    private $points = 0;

    private $name;

    public function __construct($name, $movingSpeed, $movingDuration, $stillDuration)
    {
        $this->movingSpeed = $movingSpeed;
        $this->movingDuration = $movingDuration;
        $this->stillDuration = $stillDuration;
        $this->name = $name;
    }

    public function tick($currentTick)
    {
        //echo $this->name." ";
        $tick = $currentTick % ($this->movingDuration + $this->stillDuration) + 1;
        //echo $tick;

        if ($tick <= $this->movingDuration) {
            //echo " moving";
            $this->totalLength += $this->movingSpeed;
        }

        //echo PHP_EOL;

        return $this->totalLength;
    }

    public function addPoint()
    {
        $this->points++;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return "{$this->name}: {$this->totalLength}";
    }

    /**
     * @return string
     */
    public function getPointsResult()
    {
        return "{$this->name}: {$this->points}";
    }
}