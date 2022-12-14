<?php

declare(strict_types=1);

namespace RLTSquare\Unit3\Controller\Account;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * class for rendering blank page
 */
class Unit3 implements ActionInterface
{
    /**
     * @var PageFactory
     */
    private PageFactory $pageFactory;

    /**
     * constructor
     *
     * @param PageFactory $pageFactory
     */
    public function __construct(
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
    }

    /**
     * execute method to create pagefactory object for rendering blank page
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
