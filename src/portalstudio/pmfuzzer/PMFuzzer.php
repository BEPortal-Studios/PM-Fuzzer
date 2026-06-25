<?php

namespace portalstudio\pmfuzzer;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use portalstudio\pmfuzzer\harvester\CommandHarvester;
use portalstudio\pmfuzzer\payload\Payload;
use portalstudio\pmfuzzer\report\FuzzReport;

class PMFuzzer
{
    public static function fuzz(CommandSender $sender, Command $cmd, Payload ...$payloadArgs): FuzzReport
    {
        $commandInfo = CommandHarvester::harvest($cmd, count($payloadArgs));
        $reportEntries = FuzzRunner::run($sender, $commandInfo, $payloadArgs);
        return new FuzzReport($reportEntries);
    }

}