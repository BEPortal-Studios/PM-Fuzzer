<?php

namespace portalstudio\pmfuzzer\payload;

class StringPayload extends Payload
{
    public function getType(): string
    {
        return "String";
    }

    public function getNormalValue(): string
    {
        return "Hello World!";
    }

    public function getValues(): array
    {
        return array_merge(
            $this->getBlankStrings(),
            $this->getLongStrings(),
            $this->getSpecialChars(),
            $this->getUnicode(),
            $this->getInjections(),
        );
    }

    private function getBlankStrings(): array
    {
        return ["", " ", "   "];
    }

    private function getLongStrings(): array
    {
        $values = [];
        foreach ([10, 100, 1000, 10000, 100000] as $len) {
            $values[] = str_repeat("a", $len);
        }
        return $values;
    }

    private function getSpecialChars(): array
    {
        $values = [];
        foreach (['!', '@', '#', '$', '%', '^', '&', '*', '/', '\\', ';', ':', '"', "'", '`'] as $char) {
            $values[] = $char;
            $values[] = str_repeat($char, 50);
        }
        return $values;
    }

    private function getUnicode(): array
    {
        return ["éàüñ", "🔥💀⚡🎮", "\u{0000}", "\n\r\t"];
    }

    private function getInjections(): array
    {
        return [
            "../../../etc/passwd",
            "<script>alert(1)</script>",
            "' OR 1=1 --",
            "{{7*7}}",
            "%s%s%s%s%s",
        ];
    }

}