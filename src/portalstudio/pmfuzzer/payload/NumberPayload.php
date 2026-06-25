<?php

namespace portalstudio\pmfuzzer\payload;

class NumberPayload extends Payload
{
    public function getType(): string
    {
        return "Number";
    }

    public function getNormalValue(): int
    {
        return 1;
    }

    public function getValues(): array
    {
        return array_merge(
            $this->getSystemLimits(),
            $this->getAroundZero(),
            $this->getPowersOfTwo(),
            $this->getFloats(),
            $this->getStringNumbers(),
        );
    }

    private function getSystemLimits(): array
    {
        return [PHP_INT_MAX, PHP_INT_MIN, PHP_FLOAT_MAX, PHP_FLOAT_MIN, PHP_FLOAT_EPSILON];
    }

    private function getAroundZero(): array
    {
        return range(-5, 5);
    }

    private function getPowersOfTwo(): array
    {
        $values = [];
        for ($i = 0; $i <= 32; $i++) {
            $pow = pow(2, $i);
            $values[] = $pow;
            $values[] = -$pow;
            $values[] = $pow - 1;
            $values[] = $pow + 1;
        }
        return $values;
    }

    private function getFloats(): array
    {
        return [0.1, -0.1, 0.9999999, 1.0000001, 1/3];
    }

    private function getStringNumbers(): array
    {
        return ["0x1A", "0b1010", "1e999", "NaN", "Inf", "-Inf"];
    }

}