<?php

abstract class InstantSpell extends Spell
{

    abstract public function cast(Character $caster, Character $target);
}