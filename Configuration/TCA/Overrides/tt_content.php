<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
    $pluginSignature = strtolower('ExtensionContactForm') . '_' . strtolower(\FreshP\ExtensionContactForm\Statics\ExtensionStatics::CONTACT_PLUGIN_NAME);

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'FreshP.ExtensionContactForm',
        \FreshP\ExtensionContactForm\Statics\ExtensionStatics::CONTACT_PLUGIN_NAME,
        'Kontaktformular'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'typo3_application_connector_extension',
        'Configuration/TypoScript',
        'typo3_application_connector_extension'
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:typo3_application_connector_extension/Configuration/FlexForms/ContactFormPluginFlexform.xml'
    );
});
