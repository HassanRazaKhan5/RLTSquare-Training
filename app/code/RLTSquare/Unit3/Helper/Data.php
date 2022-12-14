<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 *
 */
class Data
{
    /**
     * @const
     */
    private const XML_PATH_USERNAME = 'unit3/Settings/username';

    /**
     * @const
     */
    private const XML_PATH_PASSWORD = 'unit3/Settings/password';

    /**
     * @const
     */
    private const XML_PATH_ENVIRONMENT = 'unit3/Settings/env';

    /**
     *
     */
    private const XML_PATH_CONFIGURATION = 'unit3/Settings/configuration';

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * constructor
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * method to get username from configuration
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_USERNAME, ScopeInterface::SCOPE_STORE);
    }

    /**
     * method to get user password from configuration
     *
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PASSWORD, ScopeInterface::SCOPE_STORE);
    }

    /**
     * method to get environment from configuration
     *
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENVIRONMENT, ScopeInterface::SCOPE_STORE);
    }

    /**
     * method to get user configuration status
     *
     * @return string
     */
    public function getConfiguration(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CONFIGURATION, ScopeInterface::SCOPE_STORE);
    }
}
