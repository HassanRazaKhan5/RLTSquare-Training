<?php

declare(strict_types=1);

namespace SoftRox\Task3\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;


class Example extends Template
{
    protected $request;
    public function __construct(Context $context, array $data = [] )
    {
        parent::__construct($context, $data);
    }


    public function getContent(): string
    {
        return 'Dummy content';
    }
}
