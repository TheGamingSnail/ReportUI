<?php

namespace PlateWheel\ReportUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use CortexPE\DiscordWebhookAPI\Webhook;
use CortexPE\DiscordWebhookAPI\Embed;
use CortexPE\DiscordWebhookAPI\Message;

class Main extends PluginBase {

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "report":
			 if($sender instanceof Player){
			 	$this->reportUI($sender);
			 } else {
			 	$sender->sendMessage("Soooo?");
			 }
			break;
		}
	return true;
	}

	public function reportUI($player){
		$form = $this->getServer()->getPluginManager()->getPlugin("FormAPI")->createCustomForm(function (Player $player, array $data = null){
			if($data === null){
				return true;
			}
			if($data[0] == null){
				$player->sendMessage("Please type the player name");
				return true;
			}
			if($data[1] == null){
				$player->sendMessage("Please type the reason");
				return true;
			}
			$player->sendMessage("Report has been notice for the staff ywy");
			foreach($this->getServer()->getOnlinePlayers() as $p){
				if($p->hasPermission("report.view")){
					$p->sendMessage("Reportttttt Reportttt\nName: " . $data[0] . "\n Reason: " . $data[1] . "\n Reporter: " . $player->getName() . "\n Ban Ban?");
				}
			}
			 $msg = new Message();
			 $embed = new Embed();
			 $embed->setTitle("New report uwuwuwuwuwu");
			 $embed->addField("Name", $data[0]);
			 $embed->addField("Reason", $data[1]);
			 $embed->addField("Reporter", $player->getName());
			 $embed->setFooter("Ban?");
			 $msg->addEmbed($embed);
			 $webhook->send($msg);
			 $webhook = new Webhook("https://discord.com/api/webhooks/876598099429187584/wkKXKbe2io90sGUYpdIPZebpec9qvWfpCm16XAUWXJWeYvp3bwtOl8cNRbnCaWEf1_lW");
			 $msg->addEmbed($embed);
			 $webhook->send($msg);
		});
		$form->setTitle("ReportUI");
		$form->addInput("Type a player name you want to report", "Eg: Plaet");
		$form->addInput("Type a reason why you report", "Eg: for fun :3");
		$form->sendToPlayer($player);
		return $form;
	}

}
