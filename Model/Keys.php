<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Magento\Framework\Model\AbstractModel;
use Mygento\Payment\Api\Data\KeysInterface;

class Keys extends AbstractModel implements KeysInterface
{
    /** @inheritDoc */
    protected $_eventPrefix = 'mygento_payment_keys';

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
     * Get hkey
     */
    public function getHkey(): string
    {
        return $this->getData(self::HKEY);
    }

    /**
     * Set hkey
     */
    public function setHkey(string $hkey): self
    {
        return $this->setData(self::HKEY, $hkey);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Keys::class);
    }
}
