<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Block;

use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use RLTSquare\Unit3\Helper\Data as Helper;

/**
 * block class for fetching customer information
 */
class CustomerDetails extends Template
{
    /**
     * @var Helper
     */
    private Helper $helper;
    /**
     * @var EncryptorInterface
     */
    private EncryptorInterface $encryptor;

    /**
     * constructor
     *
     * @param Context $context
     * @param Helper $helper
     * @param EncryptorInterface $encryptor
     */
    public function __construct(Context $context, Helper $helper, EncryptorInterface $encryptor)
    {
        $this->helper = $helper;
        $this->encryptor = $encryptor;
        parent::__construct($context);
    }

    /**
     * method to get username from helper
     *
     * @return string
     */
    public function userName(): string
    {
        return $this->helper->getUserName() ?? '';
    }

    /**
     * method to get userPassword from helper
     *
     * @return string
     */
    public function userPassword(): string
    {
        $password = $this->helper->getUserPassword();
        $decrypt_password = $this->encryptor->decrypt($password);
        return substr($decrypt_password, 0, 3);
    }

    /**
     * method to check assigned environment by user
     *
     * @return string
     */
    public function checkEnvironment(): string
    {
        return $this->helper->getEnvironment();
    }

    /**
     * method to check is configuration is enabled or not
     *
     * @return string
     */
    public function checkIsConfigurationEnabled(): string
    {
        return $this->helper->getConfiguration();
    }
}
