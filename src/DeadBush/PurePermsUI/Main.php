<?php

namespace DeadBush\PurePermsUI;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class Main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getLogger()->info("§6========================================");
		$this->getLogger()->info("§ePurePermsUI By DeadBush");
		$this->getLogger()->info("§eSubscribe To My YouTube Channel");
		$this->getLogger()->info("§ehttps://youtube.com/deadbush");
		$this->getLogger()->info("§6========================================");
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
		switch($cmd->getName()){
			case "pureperms":
			if($sender instanceof Player){
				if($sender->hasPermission("purepermsui.use")){
					$this->purepermsui($sender);
				}else{
					$sender->sendMessage("§4You Don't Have Permission To Use This Command");
				}
			}
		}
	return true;
	}

	public function purepermsui($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->editgroups($player);
			break;

			case 1:
			    $this->groupsinfo($player);
			break;

			case 2:
			    $this->groupperms($player);
			break;

			case 3:
			    $this->users($player);
			break;
			}
		});
		$form->setTitle("§l§6PUREPERMS §eUI");
		$form->addButton("§lEdit Groups");
		$form->addButton("§lGroups Info");
		$form->addButton("§lGroup Permissions");
		$form->addButton("§lUsers");
		$form->sendToPlayer($player);
		return $form;
	}

	public function editgroups($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->addgroup($player);
			break;

			case 1:
			    $this->defgroup($player);
			break;

			case 2:
			    $this->rmgroup($player);
			break;

			case 3:
			    $this->purepermsui($player);
		}
		});
		$form->setTitle("§l§6EDIT §eGROUPS");
		$form->addButton("§lAdd Groups");
		$form->addButton("§lDefault Group");
		$form->addButton("§lRemove Group");
		$form->addButton("§lBack");
		$form->sendToPlayer($player);
		return $form;
	}

	public function addgroup($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "addgroup " . $data[0]);
		});
		$form->setTitle("§l§6ADD §eGROUP");
		$form->addInput("§eAdd The Name Of Group You Want To Add");
		$form->sendToPlayer($player);
		return $form;
	}

	public function defgroup($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "defgroup " . $data[0]);
		});
		$form->setTitle("§l§6DEFAULT §eGROUP");
		$form->addInput("§eAdd The Name Of Group You Want To Make As Default");
		$form->sendToPlayer($player);
		return $form;
	}

	public function rmgroup($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "rmgroup " . $data[0]);
		});
		$form->setTitle("§l§6REMOVE §eGROUP");
		$form->addInput("§eAdd The Name Of Group You Want To Remove");
		$form->sendToPlayer($player);
		return $form;
	}

	public function groupsinfo($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->getServer()->dispatchCommand($player, "groups");
			break;

			case 1:
			    $this->grpinfo($player);
			break;

			case 2:
			    $this->listgperms($player);
			break;

			case 3:
			    $this->purepermsui($player);
			break;
		}
		});
		$form->setTitle("§l§6GROUPS §eINFO");
		$form->addButton("§lGroups");
		$form->addButton("§lGroup Info");
		$form->addButton("§lList Perms");
		$form->addButton("§lBack");
		$form->sendToPlayer($player);
		return $form;
	}

	public function grpinfo($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "grpinfo " . $data[0]);
		});
		$form->setTitle("§l§6GROUP §eINFO");
		$form->addInput("§eAdd The Name Of Group You Want To Get Info");
		$form->sendToPlayer($player);
		return $form;
	}

	public function listgperms($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "listgperms " . $data[0]);
		});
		$form->setTitle("§l§6LIST §ePERMS");
		$form->addInput("§eAdd The Name Of Group You Want To See Perms");
		$form->sendToPlayer($player);
		return $form;
	}

	public function groupperms($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->setgperm($player);
			break;

			case 1:
			    $this->unsetgperm($player);
			break;

			case 2:
			    $this->purepermsui($player);
			break;
		}
		});
		$form->setTitle("§l§6ADD §ePERMS");
		$form->addButton("§lAdd Perms");
		$form->addButton("§lRemove Perms");
		$form->addButton("§lBack");
		$form->sendToPlayer($player);
		return $form;
	}

	public function setgperm($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "setgperm " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§6ADD §ePERMS");
		$form->addInput("§eEnter The Group Name");
		$form->addInput("§eEnter The Permission To Add");
		$form->sendToPlayer($player);
		return $form;
	}

	public function unsetgperm($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "unsetgperm " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§6REMOVE §ePERMS");
		$form->addInput("§eAdd The Group Name");
		$form->addInput("§eEnter The Permission To Remove");
		$form->sendToPlayer($player);
		return $form;
	}

	public function users($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, int $data = null){
			if($data === null){
				return true;
			}
		switch($data){
			case 0:
			    $this->setgroup($player);
			break;

			case 1:
			    $this->setuperm($player);
			break;

			case 2:
			    $this->unsetuperm($player);
			break;

			case 3:
			    $this->usrinfo($player);
			break;

			case 4:
			    $this->purepermsui($player);
			break;
		}
		});
		$form->setTitle("§l§6USERS");
		$form->addButton("§lSet Group");
		$form->addButton("§lSet Player Perms");
		$form->addButton("§lUnset Player Perms");
		$form->addButton("§lUser Info");
		$form->addButton("§lBack");
		$form->sendToPlayer($player);
		return $form;
	}

	public function setgroup($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "setgroup " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§6SET §eGROUP");
		$form->addInput("§eAdd The Name Of The Player");
		$form->addInput("§eEnter The Group");
		$form->sendToPlayer($player);
		return $form;
	}

	public function setuperm($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "setuperm " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§6SET USER §ePERM");
		$form->addInput("§eEnter The Name Of The Player");
		$form->addInput("§eEnter The Permission To Add");
		$form->sendToPlayer($player);
		return $form;
	}

	public function unsetuperm($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "unsetuperm " . $data[0] . " " . $data[1]);
		});
		$form->setTitle("§l§6UNSET USER §ePERM");
		$form->addInput("§eEnter The Name Of The Player");
		$form->addInput("§eEnter The Permission To Remove");
		$form->sendToPlayer($player);
		return $form;
	}

	public function usrinfo($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
		$this->getServer()->dispatchCommand($player, "usrinfo " . $data[0]);
		});
		$form->setTitle("§l§6USER §eINFO");
		$form->addInput("§eEnter The Name Of The Player");
		$form->sendToPlayer($player);
		return $form;
	}
}