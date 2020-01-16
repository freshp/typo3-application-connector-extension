<?php declare(strict_types=1);

namespace FreshP\Typo3ApplicationConnectorExtension\Generator;

use FreshP\Typo3ApplicationConnectorExtension\Statics\ExtensionStatics;

final class Typo3UrlParameterGenerator
{
    public static function generate(string $pluginName): string
    {
        return sprintf(
            'tx_%s_%s',
            strtolower(ExtensionStatics::EXTENSION_NAME),
            strtolower($pluginName)
        );
    }
}
