<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface RegistrationInterface
{
    const ID = 'id';
    const CODE = 'code';
    const ORDER_ID = 'order_id';
    const PAYMENT_ID = 'payment_id';
    const PAYMENT_URL = 'payment_url';
    const TRY = 'try';
    const PAYMENT_TYPE = 'payment_type';
    const CREATED_AT = 'created_at';

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
     * Get payment id
     * @return string|null
     */
    public function getPaymentId();

    /**
     * Set payment id
     * @param string $paymentId
     * @return $this
     */
    public function setPaymentId($paymentId);

    /**
     * Get payment url
     * @return string|null
     */
    public function getPaymentUrl();

    /**
     * Set payment url
     * @param string $paymentUrl
     * @return $this
     */
    public function setPaymentUrl($paymentUrl);

    /**
     * Get try
     * @return int|null
     */
    public function getTry();

    /**
     * Set try
     * @param int $try
     * @return $this
     */
    public function setTry($try);

    /**
     * Get payment type
     * @return string|null
     */
    public function getPaymentType();

    /**
     * Set payment type
     * @param string $paymentType
     * @return $this
     */
    public function setPaymentType($paymentType);

    /**
     * Get created at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);
}
