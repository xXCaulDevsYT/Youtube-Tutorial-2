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
        case "bcui":
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
                    $sender->addTitle("§cYou Stop", "§cSelecting Some Commands.");
                        break;
                    case 1:
                    $sender->addTitle("§6Healed", "§fYou Have Been Healed.");
                    $sender->setHealth(20);
						break;
                    case 2:
                    $sender->addTitle("§6Feeded", "§fYou Have Been Feeded.");
                    $sender->setFood(20);
                        break;
                    case 3:
                    $sender->addTitle("§6InventoryCleared", "§fYour Inventory Has Been Cleared.");
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
        $form->setTitle("§l§aBasicCommandUI");
        $form->setContent("§7Select Your Commands.");
        $form->addButton("§4Exit", 0);
        $form->addButton("§lHeal", 1);
        $form->addButton("§lFeed", 2);
        $form->addButton("§lClearInventory", 3);
        $form->addButton("§lGamemode", 4);
        $form->addButton("§lFly", 5);
        $form->addButton("§lVanish", 6);
        $form->addButton("§lGive", 7);
        $form->addButton("§lKick", 8);
        $form->addButton("§lBan", 9);
        $form->addButton("§lNickname", 10);
        $form->addButton("§lEnchant", 11);
        $form->addButton("§lSize", 12);
        $form->addButton("§lKits", 13);
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
                    $command = "bcui";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->addTitle("§6Your Gamemode", "§fHas Been Changed Into Survival.");
                    $sender->setGamemode(0);
                        break;
                    case 2:
                    $sender->addTitle("§6Your Gamemode", "§fHas Been Changed Into Creative.");
                    $sender->setGamemode(1);
                        break;
                    case 3:
                    $sender->addTitle("§6Your Gamemode", "§fHas Been Changed Into Adventure.");
                    $sender->setGamemode(2);
                        break;
                    case 4:
                    $sender->addTitle("§6Your Gamemode", "§fHas Been Changed Into Spectator.");
                    $sender->setGamemode(3);
                        break;
            }
        });
        $form->setTitle("§l§aGamemodeUI");
        $form->setContent("§7Select Your Gamemode");
        $form->addButton("§4Back", 0);
        $form->addButton("§lSurvival", 1);
        $form->addButton("§lCreative\nTest", 2);
        $form->addButton("§lAdventure", 3);
        $form->addButton("§lSpectator", 4);
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
                    $command = "bcui";
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
        $form->setTitle("§l§aFlyUI");
        $form->setContent("§7Enable Or Disable Your Fly");
        $form->addButton("§4Back", 0);
        $form->addButton("§lFly Enable", 1);
        $form->addButton("§lFly Disable", 2);
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
                    $command = "bcui";
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
        $form->setTitle("VanishUI");
        $form->setContent("§7Enable Or Disable Your Vanish");
        $form->addButton("§4Back");
        $form->addButton("§lOn");
        $form->addButton("§lOff");
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
        $form->setTitle("§lGiveUI");
        $form->addInput("§7Write Playername ItemID Amount");
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
        $form->setTitle("§lKickUI");
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
        $form->setTitle("§lBanUI");
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
				$form->setTitle("§lNicknameUI");
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
                    $command = "bcui";
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
        $form->setTitle("§lSizeUI");
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
        $form->setTitle("§lEnchantUI");
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
                    $command = "bcui";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
                        break;
                    case 1:
                    $sender->sendMessage("§l§6Kit §8» §7You Received §6FFA §7Kit");
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
        $form->setTitle("§l§aKitUI");
        $form->setContent("§7Please Select Your Kit");
        $form->addButton("§4Back", 0);
        $form->addButton("§lFFA", 1);
        $form->sendToPlayer($sender);
    }
    
    public function onJoin(PlayerJoinEvent $event){
	$player = $event->getPlayer();
	$name = $player->getName();
	$event->setJoinMessage("");
	$this->getServer()->broadcastMessage("§l§8[§a+§8]§r §e" . $name);
	}
	
	public function onQuit(PlayerQuitEvent $event){
	$player = $event->getPlayer();
	$name = $player->getName();
	$event->setQuitMessage("");
	$this->getServer()->broadcastMessage("§l§8[§c-§8]§r §e" . $name);
	}
    
    public function onDisable(){
        $this->getLogger()->info("- BasicCommandUI Disabled!");
    }
}
