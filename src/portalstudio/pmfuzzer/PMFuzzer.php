<?php

namespace portalstudio\pmfuzzer;

use pocketmine\command\Command;
use portalstudio\pmfuzzer\harvester\CommandHarvester;
use portalstudio\pmfuzzer\payload\Payload;
use portalstudio\pmfuzzer\report\FuzzReport;

class PMFuzzer
{
    public static function fuzz(Command $cmd, Payload ...$payloadArgs): FuzzReport
    {
        $commandInfo = CommandHarvester::harvest($cmd, count($payloadArgs));
        $reportEntries = FuzzRunner::run($commandInfo, $payloadArgs);
        return new FuzzReport($reportEntries);
    }

}