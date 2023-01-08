<?php

namespace SwiftOtter\OrderExport\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * configuration class.
 */
class Config
{
    /**
     * @const
     */
    public const CONFIG_PATH_ENABLED = 'sales/order_export/enabled';

    private ScopeConfigInterface $scopeConfig;

    /**
     * constructor.
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * method to check is configuration enabled or not.
     */
    public function isEnabled(string $scopeType = ScopeInterface::SCOPE_STORE, ?string $scopeCode = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_ENABLED);
    }
}
