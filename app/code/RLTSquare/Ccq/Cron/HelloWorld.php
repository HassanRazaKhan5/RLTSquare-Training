<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Cron;

use Exception;
use Psr\Log\LoggerInterface;

/**
 *helloWorld Cron class
 */
class HelloWorld
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * method to write system.log when cron command executed
     *
     * @return void
     */
    public function execute(): void
    {
        try {
            $this->logger->info('hello world from rltsquare_hello_world cron job');
        } catch (Exception $exception) {
            $this->logger->error("Cron: " . $exception->getMessage());
        }
    }
}
