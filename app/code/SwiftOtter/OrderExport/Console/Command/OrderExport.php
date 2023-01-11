<?php

namespace SwiftOtter\OrderExport\Console\Command;

use DateTime;
use Exception;
use SwiftOtter\OrderExport\Model\HeaderData;
use SwiftOtter\OrderExport\Model\HeaderDataFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *OrderExport command class.
 */
class OrderExport extends Command
{
    /**
     * @const
     */
    private const ARG_NAME_ORDER_ID = 'order-id';
    /**
     * @const
     */
    private const OPTION_NAME_SHIP_DATE = 'ship-date';
    /**
     * @const
     */
    private const OPTION_NAME_MERCHANT_NOTES = 'notes';

    private HeaderDataFactory $headerDataFactory;

    /**
     * constructor.
     */
    public function __construct(HeaderDataFactory $headerDataFactory, string $name = null)
    {
        $this->{$headerDataFactory} = $headerDataFactory;
        parent::__construct($name);
    }

    /**
     * method to configure command.
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
     * method to write command code.
     *
     * @throws Exception
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $orderId = (int) $input->getArgument(self::ARG_NAME_ORDER_ID);
        $notes = $input->getOption(self::OPTION_NAME_MERCHANT_NOTES);
        $shipDate = $input->getOption(self::OPTION_NAME_SHIP_DATE);

        /**
         * @var HeaderData $headerData
         */
        $headerData = $this->headerDataFactory->create();

        if ($shipDate) {
            $headerData->setShipDate(new DateTime($shipDate));
        }
        if ($notes) {
            $headerData->setMerchantNotes($notes);
        }
        $output->writeln(print_r($headerData, true));

        return 0;
    }
}
