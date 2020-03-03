<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface KeysInterface
{
    const ID = 'id';
    const CODE = 'code';
    const ORDER_ID = 'order_id';
    const HKEY = 'hkey';

    /**
     * Get id
     * @return int|null
     */
    public function getId();

    /**
     * Set id
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return $this
     */
    public function setCode($code);

    /**
     * Get order id
     * @return int|null
     */
    public function getOrderId();

    /**
     * Set order id
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * Get hkey
     * @return string|null
     */
    public function getHkey();

    /**
     * Set hkey
     * @param string $hkey
     * @return $this
     */
    public function setHkey($hkey);
}
