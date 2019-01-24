<?php

namespace FreshP\ExtensionContactForm\Tests\Unit\Generator;

use FreshP\ExtensionContactForm\Generator\Typo3UrlParameterGenerator;
use PHPUnit\Framework\TestCase;

class Typo3UrlParameterGeneratorTest extends TestCase
{
    public function testFactoryCreationOfObject()
    {
        $extensionName = 'extension';
        $pluginName = 'plugin';

        $result = Typo3UrlParameterGenerator::generate(
            $extensionName,
            $pluginName
        );

        $this->assertContains($extensionName, $result);
        $this->assertContains($pluginName, $result);
        $this->assertContains('tx_', $result);
    }
}
