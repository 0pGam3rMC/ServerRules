<?php

/*
 * ServerRules - A PocketMine-MP plugin to list your rules in one command
 * Copyright (C) 2017 Kevin Andrews <https://github.com/kenygamer/ServerRules>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
*/

declare(strict_types=1);

namespace ServerRules;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class ServerRules extends PluginBase{
  
  /**
   * @param CommandSender $sender
   * @param Command $cmd
   * @param string $label
   * @param string[] $args
   *
   * @return bool
   */
  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
    if(!is_array(($rules = $this->getConfig()->get("rules"))) || !is_int(($limit = $this->getConfig()->get("rules-per-page")))){
      $sender->sendMessage(TextFormat::RED . "Config is corrupted.");
      return true;
    }
    
    $page = isset($args[0]) ? (int) $args[0] : 1;
    $offset = ($page - 1) * $limit;
    
    $count = count($rules);
    $pageCount = ceil($count / $limit);
    $pageRules = array_splice($rules, $offset, $limit);
    
    if($page < 1 or $page > $pageCount){
      $sender->sendMessage(TextFormat::RED . "Page not found. Try /rules for a list of rules");
      return true;
    }
    
    if(empty($pageRules)){
      $sender->sendMessage(TextFormat::RED . "No rules to show.");
      return true;
    }
    
    $sender->sendMessage(TextFormat::DARK_GREEN . "--- Showing rules page " . $page . " of " . $pageCount . " (/rules <page>) ---");
    foreach($pageRules as $rule){
      $sender->sendMessage("- " . $rule);
    }
    return true;
  }
  
}
