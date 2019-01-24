<?php declare(strict_types=1);

namespace FreshP\ExtensionContactForm\Service;

use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

final class SessionService
{
    /**
     * @var FrontendUserAuthentication
     */
    private $userAuthentication;

    /**
     * @param FrontendUserAuthentication $userAuthentication
     */
    public function __construct(FrontendUserAuthentication $userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }

    public function set(string $key, $value): void
    {
        $this->userAuthentication->setKey('ses', $key, $value);
    }

    public function get(string $key)
    {
        return $this->userAuthentication->getKey('ses', $key);
    }

    public function clear(string $key): void
    {
        $this->userAuthentication->setKey('ses', $key, null);
    }
}
