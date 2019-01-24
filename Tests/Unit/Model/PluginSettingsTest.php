<?php

namespace FreshP\ExtensionContactForm\Tests\Unit\Model;

use FreshP\ExtensionContactForm\Model\PluginSettings;
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
