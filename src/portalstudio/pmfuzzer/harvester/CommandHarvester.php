<?php

namespace portalstudio\pmfuzzer\harvester;

use pocketmine\command\Command;

class CommandHarvester
{
    /**
     * Retrieves the information needed to test the command correctly.
     * Here, we retrieve the name, permissions, number of arguments, and the command instance.
     */
    public static function harvest(Command $command, int $maxArgs): CommandInfo
    {
        $name = $command->getName();
        $permissions = $command->getPermissions();
        $commandInfo = CommandInfo::make($name, $permissions, $maxArgs, $command);
        return $commandInfo;
    }

}