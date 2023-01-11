<?php

namespace SwiftOtter\OrderExport\Model;

use DateTime;

/**
 *Transport class to encapsulate data
 */
class HeaderData
{
    /**
     * @var ?DateTime
     */
    private ?DateTime $shipDate;

    /**
     * @var string
     */
    private string $merchantNotes;

    /**
     * @return DateTime|null
     */
    public function getShipDate(): ?DateTime
    {
        return $this->shipDate;
    }

    /**
     * @param DateTime|null $shipDate
     *
     * @return void
     */
    public function setShipDate(?DateTime $shipDate): void
    {
        $this->shipDate = $shipDate;
    }

    /**
     * @return string
     */
    public function getMerchantNotes(): string
    {
        return $this->merchantNotes;
    }

    /**
     * @param string $merchantNotes
     *
     * @return void
     */
    public function setMerchantNotes(string $merchantNotes): void
    {
        $this->merchantNotes = $merchantNotes;
    }
}
