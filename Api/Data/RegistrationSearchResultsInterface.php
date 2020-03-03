<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface RegistrationSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
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
