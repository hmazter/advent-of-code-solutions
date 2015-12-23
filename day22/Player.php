<?php

class Player extends Character
{
    private $mana = 0;

    private $spentMana = 0;

    private $selectedSpell;

    /**
     * Player constructor.
     * @param $mana
     */
    public function __construct($hitpoints, $mana)
    {
        parent::__construct($hitpoints, 0);

        $this->mana = $mana;
    }

    public function printInfo()
    {
        echo "- Player has {$this->getHitpoints()} hit points, {$this->getArmor()} armor, {$this->getMana()} mana\n";
    }

    public function selectSpell(array $spells, Boss $boss)
    {
        while (count($spells) > 0) {
            /** @var Spell $spell */
            $spellIndex = array_rand($spells, 1);
            $spellName = $spells[$spellIndex];
            $spell = new $spellName;
            if (!$this->isSpellActive($spell) && !$boss->isSpellActive($spell) && $spell->getCost() <= $this->getMana()) {
                $this->selectedSpell = $spell;
                return true;
            } else {
                unset($spells[$spellIndex]);
            }
        }

//        echo "No spell available, player dies\n";
        $this->setHitpoints(0);
        return false;
    }

    public function cast(Boss $boss)
    {
        $cost = $this->getSelectedSpell()->getCost();
        $this->mana -= $cost;
        $this->spentMana += $cost;

        if ($this->getSelectedSpell() instanceof InstantSpell) {
            /** @var InstantSpell $spell */
            $spell = $this->getSelectedSpell();
            $spell->cast($this, $boss);
            return $spell->getName();
        }

        /** @var EffectSpell $spell */
        $spell = $this->getSelectedSpell();
//        echo "Player casts {$spell->getName()}\n";

        if($spell instanceof DamageSpell) {
            // add to boss active spells
            $boss->addSpell($spell);
            return $spell->getName();
        }

        $this->addSpell($spell);
        return $spell->getName();
    }

    /**
     * @return Spell
     */
    public function getSelectedSpell()
    {
        return $this->selectedSpell;
    }

    /**
     * @return int
     */
    public function getMana()
    {
        return $this->mana;
    }

    /**
     * @param int $mana
     */
    public function setMana($mana)
    {
        $this->mana = $mana;
    }

    /**
     * @return mixed
     */
    public function getSpentMana()
    {
        return $this->spentMana;
    }
}
