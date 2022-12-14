<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Console\Command;

use Exception;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * class for helloworld command
 */
class HelloWorld extends Command
{
    /**
     * @const
     */
    private const INPUT_OPTION_VAR1 = 'var1';

    /**
     * @const
     */
    private const INPUT_OPTION_VAR2 = 'var2';

    /**
     * @const
     */
    private const TOPIC = 'rltsquare_hello_world';

    /**
     * @var PublisherInterface
     */
    private PublisherInterface $publisher;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var Json
     */
    private Json $json;

    /**
     * constructor
     *
     * @param LoggerInterface $logger
     * @param PublisherInterface $publisher
     * @param Json $json
     * @param string|null $name
     */
    public function __construct(
        LoggerInterface $logger,
        PublisherInterface $publisher,
        Json $json,
        string $name = null
    ) {
        $this->logger = $logger;
        $this->publisher = $publisher;
        $this->json = $json;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('rltsquare:hello:world');
        $this->setDescription('RLTSquare Training Unit2 Command');
        $this->setDefinition([
            new InputOption(
                self::INPUT_OPTION_VAR1,
                null,
                InputOption::VALUE_REQUIRED,
                'var1'
            ),
            new InputOption(
                self::INPUT_OPTION_VAR2,
                null,
                InputOption::VALUE_REQUIRED,
                'var2'
            )
        ]);
        parent::configure();
    }

    /**
     * method to display command output & publish a message to a specific queue
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $exitCode = 0;
        try {
            if (($var1 = $input->getOption(self::INPUT_OPTION_VAR1)) && ($var2 = $input->getOption(self::INPUT_OPTION_VAR2))) {
                $output->writeln("<info>added to rltsquare_hello_world job to a queue, passing it these $var1 && $var2 two parameters.</info>");
                $this->publisher->publish(self::TOPIC, $this->json->serialize(implode(',', [
                    'var1' => $var1,
                    'var2' => $var2
                ])));
                $this->logger->info("['var1' => $var1, 'var2' => $var2]  added message to the  queue");
            }
        } catch (Exception $exception) {
            $output->writeln(sprintf('<error>%s</error>', $exception->getMessage()));
            $exitCode = 1;
        }
        return $exitCode;
    }
}
