<?php

declare(strict_types=1);

namespace RLTSquare\Training\ViewModel;

use Exception;
use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;

/**
 * view model class
 */
class EmailViewModel implements ArgumentInterface
{
    /**
     * @const
     */
    const XML_PATH_EMAIL_TEMPLATE_FIELD = 'rltsquare/training_email/template';

    /**
     * @var StateInterface
     */
    private StateInterface $inlineTranslation;

    /**
     * @var Escaper
     */
    private Escaper $escaper;

    /**
     * @var TransportBuilder
     */
    private TransportBuilder $transportBuilder;

    /**
     * @var ManagerInterface
     */
    private ManagerInterface $messageManager;

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param ManagerInterface $messageManager
     * @param TransportBuilder $transportBuilder
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        StateInterface $inlineTranslation,
        Escaper $escaper,
        ManagerInterface $messageManager,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->messageManager = $messageManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return void
     */
    public function sendEmail(): void
    {
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Test'),
                'email' => $this->escaper->escapeHtml('Hassan.raza@rltsquare.com'),
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($this->getEmailTemplateName())
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => Store::DEFAULT_STORE_ID,
                    ]
                )->setTemplateVars(
                    [
                        'templateVar' => 'My Email',
                    ]
                )->setFromByScope($sender)->addTo('Hassan.raza@rltsquare.com')->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage('Error:' . $e->getMessage());
        }
    }

    /**
     * @return string
     */
    private function getEmailTemplateName(): string
    {
        return $this->scopeConfig->getValue(
            static::XML_PATH_EMAIL_TEMPLATE_FIELD,
            ScopeInterface::SCOPE_STORE
        );
    }
}
