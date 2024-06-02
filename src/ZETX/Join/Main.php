<?php

namespace ZETX\Join;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent};
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
  public Config $cfg;
  
  public function onEnable() : void {
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->notice("Plugin Successfully Activated");
    $this->saveResource("config.yml");
    $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
  }
  
  /** @param PlayerJoinEvent */
  public function onJoin(PlayerJoinEvent $event) {
    $player = $event->getPlayer();
    $event->setJoinMessage(str_replace("{player}", $player->getName(), $this->cfg->get("Join-Message")));
  }
  
  /** @param PlayerQuitEvent */
  public function onQuit(PlayerQuitEvent $event) {
    $player = $event->getPlayer();
    $playerName = $player->getName();
    $event->setQuitMessage(str_replace("{player}", $player->getName(), $this->cfg->get("Quit-Message")));
  }
}