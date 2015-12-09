<?php

class City
{
    public $name;
    public $connections = [];

    /**
     * City constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
