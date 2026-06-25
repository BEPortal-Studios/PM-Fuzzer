<?php

namespace portalstudio\pmfuzzer\report;

class ReportEntry
{
    public function __construct(
        private readonly bool $success,
        private readonly string $commandName,
        private readonly string $payloadType,
        private readonly mixed $fuzzedValue,
        private readonly int $argPosition,
        private readonly ?\Throwable $exception
    )
    {}

    public static function make(bool $success, string $commandName, string $payloadType, string $fuzzedValue, int $argPosition, string $exception = null): self
    {
        return new self($success, $commandName, $payloadType, $fuzzedValue, $argPosition, $exception);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function getPayloadType(): string
    {
        return $this->payloadType;
    }

    public function getFuzzedValue(): mixed
    {
        return $this->fuzzedValue;
    }

    public function getArgPosition(): int
    {
        return $this->argPosition;
    }

    public function getException(): ?\Throwable
    {
        return $this->exception;
    }

}