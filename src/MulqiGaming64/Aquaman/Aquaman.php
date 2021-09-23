<?php

namespace MulqiGaming64\Aquaman;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\entity\Living;

use MulqiGaming64\Aquaman\Commands\AquamanCommands;

class Aquaman extends PluginBase{
	
	/** @return array */
	private $aquaman = [];
	
    public function onEnable(){
    	$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(
        	function(int $currentTick): void{
            	foreach($this->getServer()->getOnlinePlayers() as $player){
					$name = strtolower($player->getName());
					if(isset($this->aquaman[$name])){
						if($player instanceof Living){
							// force the player to keep breathing in the water
							if(!$player->isBreathing()){
								$player->setAirSupplyTicks($player->getMaxAirSupplyTicks()); // Force Breath
							}
						}
					}
				}
            }
        ), 20);
    	$this->getServer()->getCommandMap()->register("Aquaman",  new AquamanCommands($this));
    }
    
    public function setAquaman(Player $player): bool{
    	$name = strtolower($player->getName());
    	if(isset($this->aquaman[$name])){
    		unset($this->aquaman[$name]);
    		return false;
    	} else {
    		$this->aquaman[$name] = true;
    		return true;
    	}
    }
}
