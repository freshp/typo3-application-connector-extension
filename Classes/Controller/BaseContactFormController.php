<?php declare(strict_types=1);

namespace FreshP\ExtensionContactForm\Controller;

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\Model\ContactFormModel;
use FreshP\ContactFormApplication\ViewBuilder\Facades\ViewFacade;
use FreshP\ContactFormApplication\ViewBuilder\Factories\ViewFacadeFactory;
use FreshP\ExtensionContactForm\Factory\PluginSettingsFactory;
use FreshP\ExtensionContactForm\Generator\Typo3UrlParameterGenerator;
use FreshP\ExtensionContactForm\Model\PluginSettings;
use FreshP\ExtensionContactForm\Service\SessionService;
use FreshP\ExtensionContactForm\Statics\ExtensionStatics;
use Symfony\Component\Form\FormErrorIterator;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;

abstract class BaseContactFormController extends ActionController
{
    /**
     * @var PluginSettings
     */
    protected $pluginSettings;

    /**
     * @var SessionService
     */
    protected $sessionService;

    public function initializeAction(): void
    {
        $this->sessionService = new SessionService($GLOBALS['TSFE']->fe_user);
        $this->pluginSettings = PluginSettingsFactory::create($this->settings);
    }

    protected function getActionUrl(
        string $actionName,
        string $pluginName = ExtensionStatics::CONTACT_PLUGIN_NAME,
        $cHash = true
    ): string {
        return $this->uriBuilder
            ->reset()
            ->setTargetPageUid((int)$GLOBALS['TSFE']->id)
            ->setArguments([
                Typo3UrlParameterGenerator::generate(
                    $this->extensionName,
                    $pluginName
                ) => [
                    'action' => $actionName,
                ]
            ])
            ->setUseCacheHash($cHash)
            ->buildFrontendUri();
    }

    protected function generateViewFacade(string $packageName): ViewFacade
    {
        $vendorDirectory = \dirname(__DIR__, 6) . '/vendor';

        $viewConfiguration = ViewConfigurationFactory::create(
            $vendorDirectory,
            sprintf('%s/%s', $vendorDirectory, $packageName),
            $GLOBALS['TSFE']->config['config']['language']
        );

        return ViewFacadeFactory::create($viewConfiguration);
    }

    /**
     * @throws StopActionException
     */
    protected function handleError(\Throwable $throwable, string $targetActionName): void
    {
        if (true === $throwable instanceof StopActionException) {
            // StopActionException is the default redirect Exception of TYPO3 and should be thrown
            throw new $throwable;
        }

        $this->forward(
            $targetActionName,
            $this->request->getControllerName(),
            $this->request->getControllerExtensionName(),
            [
                ExtensionStatics::FORM_ERROR_PARAMETER => true,
            ]
        );
    }

    /**
     * @throws StopActionException
     */
    protected function handleFormData(
        FormErrorIterator $errorIterator,
        string $targetActionName,
        ?ContactFormModel $contactFormModel = null
    ): void {
        if (null === $contactFormModel) {
            $this->forward(
                ExtensionStatics::STEP_ONE,
                $this->request->getControllerName(),
                $this->request->getControllerExtensionName(),
                [ExtensionStatics::FORM_ERROR_PARAMETER => true,]
            );
        }

        $this->sessionService->set(ExtensionStatics::CONTACT_FORM_SESSION_KEY, $contactFormModel);

        if (0 < $errorIterator->count()) {
            $this->forward(
                $targetActionName,
                $this->request->getControllerName(),
                $this->request->getControllerExtensionName(),
                [ExtensionStatics::FORM_ERROR_PARAMETER => true]
            );
        }
    }
}
