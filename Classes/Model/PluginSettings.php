<?php declare(strict_types=1);

namespace FreshP\ExtensionContactForm\Model;

final class PluginSettings
{
    private $contactFormHint;
    private $startPid;

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
