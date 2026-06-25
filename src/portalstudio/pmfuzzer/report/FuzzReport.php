<?php

namespace portalstudio\pmfuzzer\report;

class FuzzReport
{
    /**
     * @param ReportEntry[] $entries
     */
    public function __construct(
        private readonly array $entries = []
    )
    {}

    public function getAll(): array
    {
        return $this->entries;
    }

    /**
     * @return ReportEntry[]
     */
    public function getSuccesses(): array
    {
        return array_filter($this->entries, fn(ReportEntry $e) => $e->isSuccess());
    }

    /**
     * @return ReportEntry[]
     */
    public function getFailures(): array
    {
        return array_filter($this->entries, fn(ReportEntry $e) => !$e->isSuccess());
    }

    public function hasFailures(): bool
    {
        return !empty($this->getFailures());
    }

    public function count(): int
    {
        return count($this->entries);
    }

}