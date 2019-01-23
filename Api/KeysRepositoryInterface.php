<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api;

interface KeysRepositoryInterface
{
    /**
     * Save Keys
     * @param \Mygento\Payment\Api\Data\KeysInterface $entity
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\KeysInterface
     */
    public function save(Data\KeysInterface $entity);

    /**
     * Retrieve Keys
     * @param int $entityId
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\KeysInterface
     */
    public function getById($entityId);

    /**
     * Retrieve Keys entities matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\KeysSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Keys
     * @param \Mygento\Payment\Api\Data\KeysInterface $entity
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function delete(Data\KeysInterface $entity);

    /**
     * Delete Keys
     * @param int $entityId
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function deleteById($entityId);
}
