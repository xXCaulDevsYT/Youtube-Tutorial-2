<?php

namespace BasicCommandUI;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use jojoe77777\FormAPI;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Entity;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\command\CommandExecutor;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\command\ConsoleCommandSender;
use BasicCommandUI\Main;

class Main extends PluginBase implements Listener {
    
    public function onEnable(){
        $this->getLogger()->info("- BasicCommandUI Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->checkDepends();
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->info("§4Please install FormAPI Plugin, disabling plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        switch($cmd->getName()){
        case "staff":
        if(!($sender instanceof Player)){
                $sender->sendMessage("§7This command can't be used here. Sorry!");
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->addTitle("§l§4SUCCESS", "§cYou have Exit the StaffPanel!");
                        break;
                    case 1:
                    $sender->addTitle("§l§aSUCCESS", "§bYour §lHealth§r§b Has Been Reset!");
                    $sender->setHealth(20);
						break;
                    case 2:
                    $sender->addTitle("§l§6SUCCESS", "§7You are no longer §l§cHUNGRY§r§7!");
                    $sender->setFood(20);
                        break;
                    case 3:
                    $sender->addTitle("§l§bSUCCESS", "§dYour Inventory Has Been Emptied!");
                    $sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
                        break;
                    case 4:
                    $this->GamemodePlayerTest($sender);
                        break;
                    case 5:
                    $this->FlightPlayerTest($sender);
                        break;
                    case 6:
                    $this->vanishTest($sender);
                        break;
                    case 7:
                    $this->giveTest($sender);
                        break;
                    case 8:
                    $this->kickTest($sender);
                        break;
                    case 9:
                    $this->banTest($sender);
                        break;
                    case 10:
                    $this->nickTest($sender);
                        break;
                    case 11:
                    $this->enchantTest($sender);
                        break;
                    case 12:
                    $this->sizeTest($sender);
                        break;
                    case 13:
                    $this->kitTest($sender);
                        break;
            }
        });
        $form->setTitle("§l§bAquatic§3MC §cStaff§6Panel");
        $form->setContent("§6§eWELCOME §r§7, Fellow Staff Member To The Staff Panel Pick a Command to get Started!");
        $form->addButton("§4§lEXIT", 0);
        $form->addButton("§l§6Heal", 1);
        $form->addButton("§l§6Feed", 2);
        $form->addButton("§l§6ClearInventory", 3);
        $form->addButton("§l§6Gamemode", 4);
        $form->addButton("§l§6Fly", 5);
        $form->addButton("§l§6Vanish", 6);
        $form->addButton("§l§6Give", 7);
        $form->addButton("§l§6Kick", 8);
        $form->addButton("§l§6Ban", 9);
        $form->addButton("§l§6Nickname", 10);
        $form->addButton("§l§6Enchant", 11);
        $form->addButton("§l§6Size", 12);
        $form->addButton("§l§6Kits", 13);
        $form->sendToPlayer($sender);
        }
        return true;
    }
    public function GamemodePlayerTest($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $command = "staff";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->addTitle("§l§cSURVIVAL", "§fSurviveand Fight!");
                    $sender->setGamemode(0);
                        break;
                    case 2:
                    $sender->addTitle("§l§aCREATIVE", "§fBuild and Explore!");
                    $sender->setGamemode(1);
                        break;
                    case 3:
                    $sender->addTitle("§l§4ADVENTURE", "§fYou Cant Play in this mode!");
                    $sender->setGamemode(2);
                        break;
                    case 4:
                    $sender->addTitle("§l§7SPECTATOR", "§fCatch Them Hackers Now!");
                    $sender->setGamemode(3);
                        break;
            }
        });
        $form->setTitle("§l§d6Gamemodes");
        $form->setContent("§7Select Your Gamemode");
        $form->addButton("§4§lBack", 0);
        $form->addButton("§c§lSurvival", 1);
        $form->addButton("§l§aCreative", 2);
        $form->addButton("§l§4Adventure", 3);
        $form->addButton("§l§8Spectator", 4);
        $form->sendToPlayer($sender);
    }
    
    public function FlightPlayerTest($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $command = "staff";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->addTitle("§6Fly", "§fMode Enable.");
                    $sender->setAllowFlight(true);
                        break;
                    case 2:
                    $sender->addTitle("§6Fly", "§fMode Disable.");
                    $sender->setAllowFlight(false);
                        break;
            }
        });
        $form->setTitle("§l§aFly");
        $form->setContent("§7Enable Or Disable Your Fly");
        $form->addButton("§4§lBack", 0);
        $form->addButton("§l§aFly Enable", 1);
        $form->addButton("§l§cFly Disable", 2);
        $form->sendToPlayer($sender);
    }
    
    public function vanishTest($sender){
      $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
      $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $command = "staff";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999, 0, false));
                    $sender->addTitle("§6Vanish", "Has Been Enable");
                        break;
                    case 2:
                    $sender->removeEffect(Effect::INVISIBILITY);
                    $sender->addTitle("§6Vanish", "§fHas Been Disable");
            }
        });
        $form->setTitle("Vanish");
        $form->setContent("§7Enable Or Disable Your Vanish");
        $form->addButton("§4§lBack");
        $form->addButton("§l§aOn");
        $form->addButton("§l§cOff");
        $form->sendToPlayer($sender);
	}
    
    public function giveTest($sender){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data){
            $result = $data[0];
                        if($result != null){
                        $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "give $result");
                        $sender->addTitle("§6You Successfully", "§fGive Player Item");
                        }
                    });
        $form->setTitle("§lGive Item");
        $form->addInput("§7Usage: (player_name) (item_id) (amount)");
        $form->sendToPlayer($sender);
    }
    
    public function kickTest($sender){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data){
            $result = $data[0];
                        if($result != null){
                        $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "kick $result");
                        }
                    });
        $form->setTitle("§lKick");
        $form->addInput("§7Write Player Name Here And Reason");
        $form->sendToPlayer($sender);
    }
    
    public function banTest($sender){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data){
            $result = $data[0];
                        if($result != null){
                        $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "ban $result");
                        }
                    });
        $form->setTitle("§lBan");
        $form->addInput("§7Write Player Name Here And Reason");
        $form->sendToPlayer($sender);
    }

    public function nickTest($sender){
    	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				        $sender->setDisplayName("$data[1]");
						$sender->setNameTag("$data[1]");
						$sender->addTitle("§6Your Nickname", "§fHas Been Changed");
				    }
				});
				$form->setTitle("§lNickname");
				$form->addLabel("§7Please Write Your Custom Nickname Here");
				$form->addInput("§7Write Your Nickname Here");
				$form->sendToPlayer($sender);
    }
    
    public function sizeTest($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $command = "staff";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->addTitle("§6Your Size", "§fHas Been Changed Into Small.");
                    $sender->setScale(0.5);
                        break;
                    case 2:
                    $sender->addTitle("§6Your Size", "§fHas Been Changed Into Normal.");
                    $sender->setScale(1);
                        break;
                    case 3:
                    $sender->addTitle("§6Your Size", "§fHas Been Changed Into Big.");
                    $sender->setScale(2);
                        break;
            }
        });
        $form->setTitle("§lSize");
        $form->setContent("§7Please Select Size You Want");
        $form->addButton("§4Back", 0);
        $form->addButton("§lSmall", 1);
        $form->addButton("§lNormal", 2);
        $form->addButton("§lBig", 3);
        $form->sendToPlayer($sender);
    }
    
    public function enchantTest($sender){
$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function (Player $sender, $data){
            $result = $data[0];
                        if($result != null){
                        $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "enchant $result");
                        }
                    });
        $form->setTitle("§lEnchant");
        $form->addInput("§7Please Write {PlayerName} {Enchant} {Level}");
        $form->sendToPlayer($sender);
    }
    
    public function kitTest($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $command = "staff";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->sendMessage("§l§6Kit §8» §7You Received §6STAFF §7Kit");
					$sender->getInventory()->clearAll();
					$sender->getArmorInventory()->clearAll();
	                $sender->getInventory()->addItem(Item::get(276, 0, 1));
	                $sender->getInventory()->addItem(Item::get(364, 0, 64));
	                $sender->getInventory()->addItem(Item::get(322, 0, 32));
	                $sender->getArmorInventory()->setHelmet(Item::get(310, 0, 1));
	                $sender->getArmorInventory()->setChestplate(Item::get(311, 0, 1));
	                $sender->getArmorInventory()->setLeggings(Item::get(312, 0, 1));
	                $sender->getArmorInventory()->setBoots(Item::get(313, 0, 1));
					$sender->addTitle("§6You Received", "§fFFA kit.");
                        break;
            }
        });
        $form->setTitle("§l§aStaff Kits");
        $form->setContent("§7Please Select Your Kit");
        $form->addButton("§4§lBack", 0);
        $form->addButton("§l§dAdmin", 1);
        $form->sendToPlayer($sender);
    }
    
    public function onJoin(PlayerJoinEvent $event){
	$player = $event->getPlayer();
	$name = $player->getName();
	$event->setJoinMessage("");
	$this->getServer()->broadcastMessage("§7§l[§r§b+§l§7]§r §a" . $name);
	}
	
	public function onQuit(PlayerQuitEvent $event){
	$player = $event->getPlayer();
	$name = $player->getName();
	$event->setQuitMessage("");
	$this->getServer()->broadcastMessage("§l§7[§c-§7]§r §e" . $name);
	}
    
    public function onDisable(){
        $this->getLogger()->info("- BasicCommandUI Disabled!");
    }
}
