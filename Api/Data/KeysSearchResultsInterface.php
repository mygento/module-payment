<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface KeysSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list of Keys
     * @return \Mygento\Payment\Api\Data\KeysInterface[]
     */
    public function getItems();

    /**
     * Set list of Keys
     * @param \Mygento\Payment\Api\Data\KeysInterface[] $items
     */
    public function setItems(array $items);
}
