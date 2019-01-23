<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Magento\Framework\Model\AbstractModel;

class Keys extends AbstractModel implements \Mygento\Payment\Api\Data\KeysInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mygento\Payment\Model\ResourceModel\Keys::class);
    }

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
     * Get hkey
     * @return string|null
     */
    public function getHkey()
    {
        return $this->getData(self::HKEY);
    }

    /**
     * Set hkey
     * @param string $hkey
     * @return $this
     */
    public function setHkey($hkey)
    {
        return $this->setData(self::HKEY, $hkey);
    }
}
