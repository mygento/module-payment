<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Magento\Framework\Model\AbstractModel;

class Registration extends AbstractModel implements \Mygento\Payment\Api\Data\RegistrationInterface
{
    /**
     * Get id
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get code
     * @return string|null
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * Set code
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Get order id
     * @return int|null
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order id
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get payment id
     * @return string|null
     */
    public function getPaymentId()
    {
        return $this->getData(self::PAYMENT_ID);
    }

    /**
     * Set payment id
     * @param string $paymentId
     * @return $this
     */
    public function setPaymentId($paymentId)
    {
        return $this->setData(self::PAYMENT_ID, $paymentId);
    }

    /**
     * Get payment url
     * @return string|null
     */
    public function getPaymentUrl()
    {
        return $this->getData(self::PAYMENT_URL);
    }

    /**
     * Set payment url
     * @param string $paymentUrl
     * @return $this
     */
    public function setPaymentUrl($paymentUrl)
    {
        return $this->setData(self::PAYMENT_URL, $paymentUrl);
    }

    /**
     * Get try
     * @return int|null
     */
    public function getTry()
    {
        return $this->getData(self::TRY);
    }

    /**
     * Set try
     * @param int $try
     * @return $this
     */
    public function setTry($try)
    {
        return $this->setData(self::TRY, $try);
    }

    /**
     * Get payment type
     * @return string|null
     */
    public function getPaymentType()
    {
        return $this->getData(self::PAYMENT_TYPE);
    }

    /**
     * Set payment type
     * @param string $paymentType
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        return $this->setData(self::PAYMENT_TYPE, $paymentType);
    }

    /**
     * Get created at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mygento\Payment\Model\ResourceModel\Registration::class);
    }
}
