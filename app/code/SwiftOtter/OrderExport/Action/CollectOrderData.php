<?php

declare(strict_types=1);

namespace SwiftOtter\OrderExport\Action;

use Magento\Sales\Api\OrderRepositoryInterface;
use SwiftOtter\OrderExport\Model\HeaderData;
use SwiftOtter\OrderExport\Api\OrderDataCollectorInterface;
/**
 *
 */
class CollectOrderData
{
    /**
     * @var OrderRepositoryInterface
     */
    private OrderRepositoryInterface $orderRepository;
    /**
     * @var OrderDataCollectorInterface[]
     */
    private $orderDataCollector;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param array $orderDataCollector
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        array $orderDataCollector = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderDataCollector = $orderDataCollector;
    }

    /**
     * @param int $orderId
     * @param HeaderData $headerData
     *
     * @return array
     */
    public function execute(int $orderId, HeaderData $headerData): array
    {
        $order = $this->orderRepository->get($orderId);

        $output = [];
        foreach ($this->orderDataCollector as $collector) {
            $output = array_merge_recursive($output, $collector->collect($order, $headerData));
        }

        return $output;
    }
}
