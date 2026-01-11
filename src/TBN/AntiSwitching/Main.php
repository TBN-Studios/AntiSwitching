<?php

namespace TBN\AntiSwitching;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;

class Main extends PluginBase implements Listener {
    private bool $allowSwitching = false;

    protected function onEnable(): void {
        $this->saveDefaultConfig();
        $this->allowSwitching = $this->getConfig()->get("allow-switching", false);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function handleNoSwitch(EntityDamageByEntityEvent $event): void {
        if (!$this->allowSwitching && $event->getModifier(EntityDamageEvent::MODIFIER_PREVIOUS_DAMAGE_COOLDOWN) < 0) {
            $event->cancel();
        }
    }
} 
