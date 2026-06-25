<?php

namespace portalstudio\pmfuzzer\harvester;

use pocketmine\command\Command;

class CommandInfo
{
    public function __construct(
        private string $name,
        private array $permissions,
        private int $maxArgs,
        private Command $instance
    )
    {}

    public static function make(string $name, array $permissions, int $maxArgs, Command $instance): self
    {
        return new self($name, $permissions, $maxArgs, $instance);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPermissions(): array
    {
        return $this->permissions;
    }

    public function getMaxArgs(): int
    {
        return $this->maxArgs;
    }

    public function getInstance(): Command
    {
        return $this->instance;
    }

}