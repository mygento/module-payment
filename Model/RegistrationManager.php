<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Mygento\Payment\Model\ResourceModel\Registration\Collection;

class RegistrationManager implements \Mygento\Payment\Api\Data\RegistrationManagerInterface
{
    /**
     * @var \Mygento\Payment\Api\RegistrationRepositoryInterface
     */
    private $regRepo;

    /**
     * @var \Mygento\Payment\Model\ResourceModel\Registration\CollectionFactory
     */
    private $regCollection;

    /**
     * @var \Mygento\Payment\Api\Data\RegistrationInterfaceFactory
     */
    private $regModel;

    /**
     *
     * @param \Mygento\Payment\Api\RegistrationRepositoryInterface $regRepo
     * @param \Mygento\Payment\Model\ResourceModel\Registration\CollectionFactory $regCollection
     * @param \Mygento\Payment\Api\Data\RegistrationInterfaceFactory $regModel
     */
    public function __construct(
        \Mygento\Payment\Api\RegistrationRepositoryInterface $regRepo,
        \Mygento\Payment\Model\ResourceModel\Registration\CollectionFactory $regCollection,
        \Mygento\Payment\Api\Data\RegistrationInterfaceFactory $regModel
    ) {
        $this->regRepo = $regRepo;
        $this->regCollection = $regCollection;
        $this->regModel = $regModel;
    }

    /**
     * @param string $code
     * @param int|string $orderId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByOrderID(string $code, $orderId)
    {
        /** @var Collection $collection */
        $collection = $this->regCollection->create();
        $collection
            ->addFieldToFilter('order_id', $orderId)
            ->addFieldToFilter('code', $code)
            ->setPageSize(1);
        if ($collection->getSize() > 0) {
            return $collection->getFirstItem();
        }

        /** @var Registration $model */
        $model = $this->regModel->create();
        $model
            ->setCode($code)
            ->setOrderId($orderId);

        return $model;
    }

    /**
     * @param string $code
     * @param int|string $paymentId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByPaymentID(string $code, $paymentId)
    {
        /** @var Collection $collection */
        $collection = $this->regCollection->create();
        $collection
            ->addFieldToFilter('payment_id', $paymentId)
            ->addFieldToFilter('code', $code)
            ->setPageSize(1);
        if ($collection->getSize() > 0) {
            return $collection->getFirstItem();
        }

        /** @var Registration $model */
        $model = $this->regModel->create();
        $model
            ->setCode($code)
            ->setPaymentId($paymentId);

        return $model;
    }

    /**
     * @param string $code
     * @param int|string $orderId
     * @param int|string $paymentId
     * @param string $paymentUrl
     * @param int $try
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function createRegistration(string $code, $orderId, $paymentId, string $paymentUrl, $try = 1)
    {
        /** @var Registration $model */
        $model = $this->regModel->create();
        $model
            ->setCode($code)
            ->setPaymentId($paymentId)
            ->setOrderId($orderId)
            ->setPaymentUrl($paymentUrl)
            ->setTry($try);

        $this->regRepo->save($model);
        return $model;
    }
}
