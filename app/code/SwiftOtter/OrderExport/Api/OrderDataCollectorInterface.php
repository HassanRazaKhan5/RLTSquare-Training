<?php

declare(strict_types=1);

namespace SwiftOtter\OrderExport\Api;

use Magento\Sales\Api\Data\OrderInterface;
use SwiftOtter\OrderExport\Model\HeaderData;

/**
 *
 */
interface OrderDataCollectorInterface
{
    /**
     * @param OrderInterface $order
     * @param HeaderData $headerData
     *
     * @return array
     */
    public function collect(OrderInterface $order, HeaderData $headerData): array;
}
