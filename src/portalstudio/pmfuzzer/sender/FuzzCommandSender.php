<?php

namespace portalstudio\pmfuzzer\sender;

use pocketmine\command\CommandSender;
use pocketmine\lang\Language;
use pocketmine\lang\Translatable;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionAttachment;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\ObjectSet;

class FuzzCommandSender implements CommandSender
{
    private array $messages = [];
    private ObjectSet $permissionRecalculationCallbacks;

    public function __construct()
    {
        $this->permissionRecalculationCallbacks = new ObjectSet();
    }

    public function getName(): string
    {
        return "PMFuzzer";
    }

    public function getServer(): Server
    {
        return Server::getInstance();
    }

    public function getLanguage(): Language
    {
        return Server::getInstance()->getLanguage();
    }

    public function sendMessage(Translatable|string $message): void
    {
        $this->messages[] = $message instanceof Translatable ? $message->getText() : $message;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function clearMessages(): void
    {
        $this->messages = [];
    }

    public function getScreenLineHeight(): int
    {
        return 100;
    }

    public function setScreenLineHeight(?int $height): void
    {

    }

    public function setBasePermission(Permission|string $name, bool $grant): void
    {

    }

    public function unsetBasePermission(Permission|string $name): void
    {

    }

    public function isPermissionSet(Permission|string $name): bool
    {
        return true;
    }

    public function hasPermission(Permission|string $name): bool
    {
        return true;
    }

    public function addAttachment(Plugin $plugin, ?string $name = null, ?bool $value = null): PermissionAttachment
    {
        return new PermissionAttachment($plugin, $this);
    }

    public function removeAttachment(PermissionAttachment $attachment): void
    {

    }

    public function recalculatePermissions(): array
    {
        return [];
    }

    public function getPermissionRecalculationCallbacks(): ObjectSet
    {
        return $this->permissionRecalculationCallbacks;
    }

    public function getEffectivePermissions(): array
    {
        return [];
    }
}