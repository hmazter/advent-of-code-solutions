<?php


abstract class EffectSpell extends Spell
{
    protected $timer = 0;

    /**
     * EffectSpell constructor.
     * @param $name
     * @param $cost
     * @param int $timer
     */
    public function __construct($name, $cost, $timer)
    {
        parent::__construct($name, $cost);

        $this->timer = $timer;
    }
    
    abstract public function tick(Character $target);
}
