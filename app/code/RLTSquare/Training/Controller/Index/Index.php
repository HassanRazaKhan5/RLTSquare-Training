<?php

declare(strict_types=1);

namespace RLTSquare\Training\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use RLTSquare\Training\Logger\Logger;

/**
 * class for blank page creation
 */
class Index implements ActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param PageFactory $pageFactory
     * @param Logger $logger
     */
    public function __construct(
        PageFactory $pageFactory,
        Logger      $logger
    )
    {
        $this->pageFactory = $pageFactory;
        $this->logger = $logger;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $this->logger->info('page visited');
        return $this->pageFactory->create();
    }
}
