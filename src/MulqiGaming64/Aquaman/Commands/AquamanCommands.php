<?php

namespace MulqiGaming64\Aquaman\Commands;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use MulqiGaming64\Aquaman\Aquaman;

class AquamanCommands extends Command implements PluginIdentifiableCommand{
	
	/** @var Aquaman */
	private $plugin;
	
	public function __construct(Aquaman $plugin){
        parent::__construct("aquaman", "Turn into Aquaman", "/aquaman");
        $this->plugin = $plugin;
    }
    
	public function getPlugin(): Aquaman{
		return $this->plugin;
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
    	if($this->getPlugin()->setAquaman($sender)){
    		$sender->sendMessage("§aYou've turned into Aquaman");
    	} else {
    		$sender->sendMessage("§aYou turn into an ordinary human");
    	}
        return true;
	}
}
