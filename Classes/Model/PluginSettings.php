<?php declare(strict_types=1);

namespace FreshP\Typo3ApplicationConnectorExtension\Model;

final class PluginSettings
{
    private string $contactFormHint;
    private int $startPid;

    public function __construct(string $contactFormHint, int $startPid)
    {
        $this->contactFormHint = $contactFormHint;
        $this->startPid = $startPid;
    }

    public function getContactFormHint(): string
    {
        return $this->contactFormHint;
    }

    public function getStartPid(): int
    {
        return $this->startPid;
    }
}
