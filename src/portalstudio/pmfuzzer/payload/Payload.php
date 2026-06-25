<?php

namespace portalstudio\pmfuzzer\payload;

abstract class Payload
{
    abstract public function getType(): string;

    abstract public function getValues(): array;

    abstract public function getNormalValue(): mixed;

}