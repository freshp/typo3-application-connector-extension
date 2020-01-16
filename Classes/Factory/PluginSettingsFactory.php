<?php declare(strict_types=1);

namespace FreshP\Typo3ApplicationConnectorExtension\Factory;

use FreshP\Typo3ApplicationConnectorExtension\Model\PluginSettings;

final class PluginSettingsFactory
{
    public static function create(array $settings = []): PluginSettings
    {
        if (false === self::validateSettings($settings)) {
            throw new \RuntimeException('plugin was not configured correctly', 1548321381);
        }

        $pluginSettings = new PluginSettings(
            $settings['contact-form-hint'],
            (int)$settings['start-pid']
        );

        return $pluginSettings;
    }

    private static function validateSettings(array $settings): bool
    {
        $return = isset(
            $settings['contact-form-hint'],
            $settings['start-pid']
        );

        if (true === empty($settings['start-pid'])) {
            $return = false;
        }

        return $return;
    }
}
