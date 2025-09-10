<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface RegistrationRepositoryInterface
{
    /**
     * Save Registration
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\RegistrationInterface $entity): Data\RegistrationInterface;

    /**
     * Retrieve Registration
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $entityId): Data\RegistrationInterface;

    /**
     * Retrieve Registration entities matching the specified criteria
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): Data\RegistrationSearchResultsInterface;

    /**
     * Delete Registration
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\RegistrationInterface $entity): bool;

    /**
     * Delete Registration
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $entityId): bool;
}
