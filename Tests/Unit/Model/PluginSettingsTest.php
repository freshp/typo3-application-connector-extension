<?php

namespace FreshP\Typo3ApplicationConnectorExtension\Tests\Unit\Model;

use FreshP\Typo3ApplicationConnectorExtension\Model\PluginSettings;
use PHPUnit\Framework\TestCase;

class PluginSettingsTest extends TestCase
{
    public function testCreationAndValues()
    {
        $contactFormHint = '<h1>hint</h1>';
        $startPid = 1;

        $object = new PluginSettings(
            $contactFormHint,
            $startPid
        );

        $this->assertEquals($startPid, $object->getStartPid());
        $this->assertEquals($contactFormHint, $object->getContactFormHint());
    }
}
