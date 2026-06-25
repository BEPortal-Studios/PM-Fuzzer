<?php

use portalstudio\pmfuzzer\payload\NumberPayload;
use portalstudio\pmfuzzer\PMFuzzer;

class FuzzerTest
{
    public function test(): void {
        $invalidCommand = new InvalidCommand();
        $fuzzReport = PMFuzzer::fuzz($invalidCommand,
            payloadArgs: new NumberPayload());
        if ($fuzzReport->hasFailures()){
            var_dump("Some crashes...");
        }

        foreach ($fuzzReport->getFailures() as $failure){
            var_dump("[{$failure->getCommandName()}] error at argument {$failure->getArgPosition()} (Value: {$failure->getFuzzedValue()}): {$failure->getException()?->getMessage()}");
        }
    }
}