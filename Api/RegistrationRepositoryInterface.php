<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api;

interface RegistrationRepositoryInterface
{
    /**
     * Save Registration
     * @param \Mygento\Payment\Api\Data\RegistrationInterface $entity
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function save(Data\RegistrationInterface $entity);

    /**
     * Retrieve Registration
     * @param int $entityId
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getById($entityId);

    /**
     * Retrieve Registration entities matching the specified criteria
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\RegistrationSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Registration
     * @param \Mygento\Payment\Api\Data\RegistrationInterface $entity
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function delete(Data\RegistrationInterface $entity);

    /**
     * Delete Registration
     * @param int $entityId
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return bool true on success
     */
    public function deleteById($entityId);
}
