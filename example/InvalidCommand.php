<?php

class InvalidCommand extends \pocketmine\command\Command
{
    public function __construct()
    {
        parent::__construct("invalid", "My invalid command", "/invalid");
    }

    public function execute(\pocketmine\command\CommandSender $sender, string $commandLabel, array $args): bool
    {
        $test = 1;
        if (isset($args[0])) {
            /*if (!is_numeric($args[0])) {
                return false;
            }*/

            /* Error here */
            if ($args[0] >= 1000){
                return false;
            }

            $test += $args[0];
            $sender->sendMessage("Good, it's " . $test . " now!");
            return true;
        }

        return false;
    }

}