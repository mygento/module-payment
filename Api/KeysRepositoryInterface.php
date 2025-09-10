<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface KeysRepositoryInterface
{
    /**
     * Save Keys
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\KeysInterface $entity): Data\KeysInterface;

    /**
     * Retrieve Keys
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $entityId): Data\KeysInterface;

    /**
     * Retrieve Keys entities matching the specified criteria
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): Data\KeysSearchResultsInterface;

    /**
     * Delete Keys
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\KeysInterface $entity): bool;

    /**
     * Delete Keys
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $entityId): bool;
}
