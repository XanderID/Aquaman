<?php

namespace MulqiGaming64\Aquaman\Commands;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use MulqiGaming64\Aquaman\Aquaman;

class AquamanCommands extends Command implements PluginIdentifiableCommand{
	
	/** @var Aquaman $plugin */
	protected $plugin;
	
	public function __construct(Aquaman $plugin){
		$this->plugin = $plugin;
        parent::__construct("aquaman", "Turn into Aquaman", "/aquaman");
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
    	if(!$sender instanceof Player){
    		$sender->sendMessage("Use Commands in Game");
    		return false;
    	}
    	if(!$sender->hasPermission("aquaman.transform")){
    		$sender->sendMessage("§cYou don't Have Permissions");
    		return false;
    	}
    	if($this->plugin->setAquaman($sender)){
    		$sender->sendMessage("§aYou've turned into Aquaman");
    	} else {
    		$sender->sendMessage("§aYou turn into an ordinary human");
    	}
        return true;
	}
	
	/**
     * @return Aquaman|Plugin $plugin
     */
    public function getPlugin(): Plugin {
        return $this->plugin;
    }
}
