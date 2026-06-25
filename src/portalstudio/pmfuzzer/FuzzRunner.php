<?php

namespace portalstudio\pmfuzzer;

use portalstudio\pmfuzzer\harvester\CommandInfo;
use portalstudio\pmfuzzer\payload\Payload;
use portalstudio\pmfuzzer\report\ReportEntry;
use portalstudio\pmfuzzer\sender\FuzzCommandSender;

class FuzzRunner
{
    public static function run(CommandInfo $commandInfo, array $payloads): array {
        $sender = new FuzzCommandSender();
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

    private static function test(FuzzCommandSender $sender, CommandInfo $commandInfo, array $args, mixed $fuzzedValue, int $position, Payload $payload): ReportEntry {
        $instance = $commandInfo->getInstance();
        try {
            $instance->execute($sender, $instance->getName(), $args);
            return ReportEntry::make(true, $commandInfo->getName(), $payload->getType(), $fuzzedValue, $position);
        } catch (\Throwable $e) {
            return ReportEntry::make(false, $commandInfo->getName(), $payload->getType(), $fuzzedValue, $position, $e);
        }
    }

}