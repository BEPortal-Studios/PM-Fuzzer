<?php

namespace portalstudio\pmfuzzer;

use pocketmine\command\CommandSender;
use portalstudio\pmfuzzer\harvester\CommandInfo;
use portalstudio\pmfuzzer\payload\Payload;
use portalstudio\pmfuzzer\report\ReportEntry;

class FuzzRunner
{
    public static function run(CommandSender $sender, CommandInfo $commandInfo, array $payloads): array {
        $entries = [];
        foreach ($payloads as $position => $payload) {
            foreach ($payload->getValues() as $fuzzedValue) {
                $args = [];
                foreach ($payloads as $i => $p) {
                    $args[$i] = ($i === $position) ? $fuzzedValue : $p->getNormalValue();
                }
                $entries[] = self::test($sender, $commandInfo, $args, $fuzzedValue, $position, $payload);
            }
        }
        return $entries;
    }

    private static function test(CommandSender $sender, CommandInfo $commandInfo, array $args, mixed $fuzzedValue, int $position, Payload $payload): ReportEntry {
        $instance = $commandInfo->getInstance();
        try {
            $instance->execute($sender, $instance->getName(), $args);
            return ReportEntry::make(true, $commandInfo->getName(), $payload->getType(), $fuzzedValue, $position);
        } catch (\Throwable $e) {
            return ReportEntry::make(false, $commandInfo->getName(), $payload->getType(), $fuzzedValue, $position, $e);
        }
    }

}