<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\Collection;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RegistrationRepository implements \Mygento\Payment\Api\RegistrationRepositoryInterface
{
    /** @var \Mygento\Payment\Model\ResourceModel\Registration */
    private $resource;

    /** @var \Mygento\Payment\Model\ResourceModel\Registration\CollectionFactory */
    private $collectionFactory;

    /** @var \Mygento\Payment\Api\Data\RegistrationInterfaceFactory */
    private $entityFactory;

    /** @var \Mygento\Payment\Api\Data\RegistrationSearchResultsInterfaceFactory */
    private $searchResultsFactory;

    /**
     * @param \Mygento\Payment\Model\ResourceModel\Registration $resource
     * @param \Mygento\Payment\Model\ResourceModel\Registration\CollectionFactory $collectionFactory
     * @param \Mygento\Payment\Api\Data\RegistrationInterfaceFactory $entityFactory
     * @param \Mygento\Payment\Api\Data\RegistrationSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceModel\Registration $resource,
        ResourceModel\Registration\CollectionFactory $collectionFactory,
        \Mygento\Payment\Api\Data\RegistrationInterfaceFactory $entityFactory,
        \Mygento\Payment\Api\Data\RegistrationSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
        $this->entityFactory = $entityFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param int $entityId
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getById($entityId)
    {
        $entity = $this->entityFactory->create();
        $this->resource->load($entity, $entityId);
        if (!$entity->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(
                __('Payment Registration with id "%1" does not exist.', $entityId)
            );
        }

        return $entity;
    }

    /**
     * @param \Mygento\Payment\Api\Data\RegistrationInterface $entity
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function save(\Mygento\Payment\Api\Data\RegistrationInterface $entity)
    {
        try {
            $this->resource->save($entity);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __($exception->getMessage())
            );
        }

        return $entity;
    }

    /**
     * @param \Mygento\Payment\Api\Data\RegistrationInterface $entity
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @return bool
     */
    public function delete(\Mygento\Payment\Api\Data\RegistrationInterface $entity)
    {
        try {
            $this->resource->delete($entity);
        } catch (\Exception $exception) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(
                __($exception->getMessage())
            );
        }

        return true;
    }

    /**
     * @param int $entityId
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @return bool
     */
    public function deleteById($entityId)
    {
        return $this->delete($this->getById($entityId));
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Mygento\Payment\Api\Data\RegistrationSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Mygento\Payment\Model\ResourceModel\Registration\Collection $collection */
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $sortOrders = $criteria->getSortOrders();
        $sortAsc = SortOrder::SORT_ASC;
        $orderAsc = Collection::SORT_ORDER_ASC;
        $orderDesc = Collection::SORT_ORDER_DESC;
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == $sortAsc) ? $orderAsc : $orderDesc
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        /** @var \Mygento\Payment\Api\Data\RegistrationSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
