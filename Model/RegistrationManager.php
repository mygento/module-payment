<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

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
        $collection = $this->regCollection->create();
        $collection->addFieldToFilter('order_id', $orderId);
        $collection->addFieldToFilter('code', $code);
        if ($collection->getSize() > 0) {
            return $collection->getFirstItem();
        }
        $model = $this->regModel->create();
        $model->setData([
            'code' => $code,
            'order_id' => $orderId
        ]);
        return $model;
    }

    /**
     * @param string $code
     * @param int|string $paymentId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByPaymentID(string $code, $paymentId)
    {
        $collection = $this->regCollection->create();
        $collection->addFieldToFilter('payment_id', $paymentId);
        $collection->addFieldToFilter('code', $code);
        if ($collection->getSize() > 0) {
            return $collection->getFirstItem();
        }
        $model = $this->regModel->create();
        $model->setData([
            'code' => $code,
            'payment_id' => $paymentId
        ]);
        return $model;
    }

    /**
     * @param string $code
     * @param int|string $orderId
     * @param int|string $paymentId
     * @param string $redirectUrl
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function createRegistration(string $code, $orderId, $paymentId, string $redirectUrl)
    {
        $model = $this->regModel->create();
        $model->setData([
            'code' => $code,
            'payment_id' => $paymentId,
            'order_id' => $order_id,
        ]);
        $this->regRepo->save($model);
        return $model;
    }
}
