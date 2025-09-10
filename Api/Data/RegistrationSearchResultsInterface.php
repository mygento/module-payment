<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface RegistrationSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list of Registration
     * @return \Mygento\Payment\Api\Data\RegistrationInterface[]
     */
    public function getItems();

    /**
     * Set list of Registration
     * @param \Mygento\Payment\Api\Data\RegistrationInterface[] $items
     */
    public function setItems(array $items);
}
