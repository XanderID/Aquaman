<?php

namespace MulqiGaming64\Aquaman\Commands;

use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;
use pocketmine\utils\TextFormat;
use MulqiGaming64\Aquaman\Aquaman;

class AquamanCommands extends Command implements PluginOwned {
	
	/** @var Aquaman $plugin */
	private $plugin;
	
	public function __construct(Aquaman $plugin){
		$this->plugin = $plugin;
        parent::__construct("aquaman", "Turn into Aquaman", "/aquaman");
        $this->setPermission("aquaman.transform");
    }
    
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
    	if(!$sender instanceof Player){
    		$sender->sendMessage("Use Commands in Game");
    		return false;
    	}
    	if (!$this->testPermission($sender)) return false;
    	if($this->getOwningPlugin()->setAquaman($sender)){
    		$sender->sendMessage("§aYou've turned into Aquaman");
    	} else {
    		$sender->sendMessage("§aYou turn into an ordinary human");
    	}
        return true;
	}
	
	public function getOwningPlugin(): Aquaman{
        return $this->plugin;
    }
}
