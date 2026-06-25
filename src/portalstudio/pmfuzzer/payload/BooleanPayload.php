<?php

namespace portalstudio\pmfuzzer\payload;

class BooleanPayload extends Payload
{
    public function getType(): string
    {
        return "Boolean";
    }

    public function getNormalValue(): bool
    {
        return true;
    }

    public function getValues(): array
    {
        return array_merge(
            $this->getClassicBooleans(),
            $this->getNumericBooleans(),
            $this->getWordBooleans(),
            $this->getInvalidBooleans(),
        );
    }

    private function getClassicBooleans(): array
    {
        return ["true", "false", "True", "False", "TRUE", "FALSE"];
    }

    private function getNumericBooleans(): array
    {
        return [0, 1, -1, "0", "1"];
    }

    private function getWordBooleans(): array
    {
        return ["yes", "no", "oui", "non", "on", "off"];
    }

    private function getInvalidBooleans(): array
    {
        return ["", " ", "maybe", "null", "undefined"];
    }

}