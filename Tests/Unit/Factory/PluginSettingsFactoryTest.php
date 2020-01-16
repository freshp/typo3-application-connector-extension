<?php

namespace FreshP\Typo3ApplicationConnectorExtension\Tests\Unit\Factory;

use FreshP\Typo3ApplicationConnectorExtension\Factory\PluginSettingsFactory;
use FreshP\Typo3ApplicationConnectorExtension\Model\PluginSettings;
use PHPUnit\Framework\TestCase;

class PluginSettingsFactoryTest extends TestCase
{
    public function testFactoryCreationOfObject()
    {
        $object = PluginSettingsFactory::create([
            'contact-form-hint' => '<h1>test</h1>',
            'start-pid' => '1',
        ]);

        $this->assertInstanceOf(PluginSettings::class, $object);
    }

    /**
     * @dataProvider errorProvider
     */
    public function testErrorWhileCreationOfObject($parameter)
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(1548321381);

        PluginSettingsFactory::create($parameter);
    }

    public function errorProvider()
    {
        return [
            [
                [
                    'contact-form-hint' => '<h1>test</h1>',
                ]
            ],
            [
                [
                    'start-pid' => '6',
                ]
            ],
        ];
    }
}
