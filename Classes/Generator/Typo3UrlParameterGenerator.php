<?php declare(strict_types=1);

namespace FreshP\Typo3ApplicationConnectorExtension\Generator;

final class Typo3UrlParameterGenerator
{
    public static function generate(string $extensionName, string $pluginName): string
    {
        return sprintf(
            'tx_%s_%s',
            strtolower($extensionName),
            strtolower($pluginName)
        );
    }
}
