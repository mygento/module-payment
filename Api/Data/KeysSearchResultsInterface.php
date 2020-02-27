<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface KeysSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
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
