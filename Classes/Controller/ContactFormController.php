<?php declare(strict_types=1);

namespace FreshP\ExtensionContactForm\Controller;

use FreshP\ContactFormApplication\FormApplication;
use FreshP\ExtensionContactForm\Statics\ExtensionStatics;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException;

class ContactFormController extends BaseContactFormController
{
    /**
     * @throws StopActionException
     * @throws UnsupportedRequestTypeException
     */
    public function showStep1Action(): void
    {
        try {
            $formApplication = new FormApplication(
                $this->generateViewFacade(ExtensionStatics::FORM_PACKAGE)
            );

            $this->view->assignMultiple([
                'pluginSettings' => $this->pluginSettings,
                'form' => $formApplication->generateHtml(
                    $this->getActionUrl(ExtensionStatics::STEP_PROCESS_ONE)
                ),
            ]);
        } catch (\Throwable $throwable) {

        }
    }

    /**
     * @throws StopActionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function processStep1Action(): void
    {
        try {
            $formApplication = new FormApplication(
                $this->generateViewFacade(ExtensionStatics::FORM_PACKAGE)
            );
            $this->handleFormData(
                $formApplication->validate(),
                ExtensionStatics::STEP_ONE,
                $formApplication->mapDataToObject()
            );

            $this->redirect(ExtensionStatics::STEP_SUMMARY);
        } catch (\Throwable $throwable) {
            $this->handleError($throwable, ExtensionStatics::STEP_ONE);
        }
    }

    /**
     * @throws StopActionException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function summaryAction(): void
    {
        try {
            $this->view->assignMultiple([
                'formData' => $this->sessionService->get(ExtensionStatics::CONTACT_FORM_SESSION_KEY),
            ]);
        } catch (\Throwable $throwable) {
            $this->handleError($throwable, ExtensionStatics::STEP_ONE);
        }

        $this->sessionService->clear(ExtensionStatics::CONTACT_FORM_SESSION_KEY);
    }
}
