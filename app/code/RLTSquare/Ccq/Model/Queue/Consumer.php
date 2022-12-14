<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

use Exception;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;

/**
 *consumer class
 */
class Consumer
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var Json
     */
    private Json $json;

    /**
     * @param LoggerInterface $logger
     * @param Json $json
     */
    public function __construct(LoggerInterface $logger, Json $json)
    {
        $this->logger = $logger;
        $this->json = $json;
    }

    /**
     * queue message process method
     *
     * @param $vars
     *
     * @return void
     */
    public function process($vars): void
    {
        try {
            $params = $this->json->unserialize($vars);
            $this->logger->info("hello world from rltsquare_hello_world queue job $params");
        } catch (Exception $exception) {
            $this->logger->critical("Consumer:" . $exception->getMessage());
        }
    }
}
