<?php

namespace FreshP\Typo3ApplicationConnectorExtension\Tests\Unit\Generator;

use FreshP\Typo3ApplicationConnectorExtension\Generator\Typo3UrlParameterGenerator;
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
