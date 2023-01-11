<?php

declare(strict_types=1);

namespace SwiftOtter\OrderExport\Model;

use DateTime;

/**
 *Transport class to encapsulate data.
 */
class HeaderData
{
    private ?DateTime $shipDate;

    private string $merchantNotes;

    public function getShipDate(): ?DateTime
    {
        return $this->shipDate;
    }

    public function setShipDate(?DateTime $shipDate): HeaderData
    {
        $this->shipDate = $shipDate;
        return $this;
    }

    public function getMerchantNotes(): string
    {
        return (string) $this->merchantNotes;
    }

    public function setMerchantNotes(string $merchantNotes): HeaderData
    {
        $this->merchantNotes = $merchantNotes;
        return $this;
    }
}
