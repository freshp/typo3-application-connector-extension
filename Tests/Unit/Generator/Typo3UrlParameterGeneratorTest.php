<?php

namespace FreshP\Typo3ApplicationConnectorExtension\Tests\Unit\Generator;

use FreshP\Typo3ApplicationConnectorExtension\Generator\Typo3UrlParameterGenerator;
use FreshP\Typo3ApplicationConnectorExtension\Statics\ExtensionStatics;
use PHPUnit\Framework\TestCase;

class Typo3UrlParameterGeneratorTest extends TestCase
{
    public function testFactoryCreationOfObject()
    {
        $pluginName = 'plugin';

        $result = Typo3UrlParameterGenerator::generate($pluginName);

        $this->assertContains(strtolower(ExtensionStatics::EXTENSION_NAME), $result);
        $this->assertContains($pluginName, $result);
        $this->assertContains('tx_', $result);
    }
}
