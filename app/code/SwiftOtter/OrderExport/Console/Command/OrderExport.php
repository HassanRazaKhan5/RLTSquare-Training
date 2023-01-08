<?php

namespace SwiftOtter\OrderExport\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class OrderExport extends Command
{
    /**
     *
     */
    const ARG_NAME_ORDER_ID = 'order-id';
    /**
     *
     */
    const OPTION_NAME_SHIP_DATE = 'ship-date';
    /**
     *
     */
    const OPTION_NAME_MERCHANT_NOTES = 'notes';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('order-export:run')
            ->setDescription('Export Order to ERP')
            ->addArgument(
                self::ARG_NAME_ORDER_ID,
                InputArgument::REQUIRED,
                'Order Id'
            )->addOption(
                self::OPTION_NAME_SHIP_DATE,
                'd',
                InputOption::VALUE_OPTIONAL,
                'Shipping date in format YYYY-MM-DD '
            )->addOption(
                self::OPTION_NAME_MERCHANT_NOTES,
                null,
                InputOption::VALUE_OPTIONAL,
                'Merchant Notes'
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
            $output->writeln('Hello World, from a CLI Command!' );
        return 0;
    }
}
