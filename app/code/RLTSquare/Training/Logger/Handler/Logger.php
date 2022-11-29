<?php

declare(strict_types=1);

namespace RLTSquare\Training\Logger\Handler;

use Exception;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;

/**
 * logger class for file name
 */
class Logger extends Base
{
    /**
     * File name
     *
     * @param DriverInterface $filesystem
     * @param string|null $filePath
     * @throws Exception
     */

    public function __construct(
        DriverInterface $filesystem,
        string  $filePath = null
    )
    {
        $fileName = '/var/log/rltsquare.log';
        parent::__construct($filesystem, $filePath, $fileName);
    }
}
