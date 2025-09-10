<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Magento\Framework\Model\AbstractModel;
use Mygento\Payment\Api\Data\RegistrationInterface;

class Registration extends AbstractModel implements RegistrationInterface
{
    /** @inheritDoc */
    protected $_eventPrefix = 'mygento_payment_registration';

    /**
     * Get id
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param int $id
     */
    public function setId($id): self
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get code
     */
    public function getCode(): string
    {
        return $this->getData(self::CODE);
    }

    /**
     * Set code
     */
    public function setCode(string $code): self
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Get order id
     */
    public function getOrderId(): int
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * Set order id
     */
    public function setOrderId(int $orderId): self
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get payment id
     */
    public function getPaymentId(): string
    {
        return $this->getData(self::PAYMENT_ID);
    }

    /**
     * Set payment id
     */
    public function setPaymentId(string $paymentId): self
    {
        return $this->setData(self::PAYMENT_ID, $paymentId);
    }

    /**
     * Get payment url
     */
    public function getPaymentUrl(): string
    {
        return $this->getData(self::PAYMENT_URL);
    }

    /**
     * Set payment url
     */
    public function setPaymentUrl(string $paymentUrl): self
    {
        return $this->setData(self::PAYMENT_URL, $paymentUrl);
    }

    /**
     * Get try
     */
    public function getTry(): int
    {
        return $this->getData(self::TRY);
    }

    /**
     * Set try
     */
    public function setTry(int $try): self
    {
        return $this->setData(self::TRY, $try);
    }

    /**
     * Get payment type
     */
    public function getPaymentType(): string
    {
        return $this->getData(self::PAYMENT_TYPE);
    }

    /**
     * Set payment type
     */
    public function setPaymentType(string $paymentType): self
    {
        return $this->setData(self::PAYMENT_TYPE, $paymentType);
    }

    /**
     * Get created at
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at
     */
    public function setCreatedAt(string $createdAt): self
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Registration::class);
    }
}
