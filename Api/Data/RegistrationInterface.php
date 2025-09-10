<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface RegistrationInterface
{
    public const ID = 'id';
    public const CODE = 'code';
    public const ORDER_ID = 'order_id';
    public const PAYMENT_ID = 'payment_id';
    public const PAYMENT_URL = 'payment_url';
    public const TRY = 'try';
    public const PAYMENT_TYPE = 'payment_type';
    public const CREATED_AT = 'created_at';

    /**
     * Get id
     */
    public function getId(): ?int;

    /**
     * Set id
     * @param int $id
     */
    public function setId($id): self;

    /**
     * Get code
     */
    public function getCode(): string;

    /**
     * Set code
     */
    public function setCode(string $code): self;

    /**
     * Get order id
     */
    public function getOrderId(): int;

    /**
     * Set order id
     */
    public function setOrderId(int $orderId): self;

    /**
     * Get payment id
     */
    public function getPaymentId(): string;

    /**
     * Set payment id
     */
    public function setPaymentId(string $paymentId): self;

    /**
     * Get payment url
     */
    public function getPaymentUrl(): string;

    /**
     * Set payment url
     */
    public function setPaymentUrl(string $paymentUrl): self;

    /**
     * Get try
     */
    public function getTry(): int;

    /**
     * Set try
     */
    public function setTry(int $try): self;

    /**
     * Get payment type
     */
    public function getPaymentType(): string;

    /**
     * Set payment type
     */
    public function setPaymentType(string $paymentType): self;

    /**
     * Get created at
     */
    public function getCreatedAt(): string;

    /**
     * Set created at
     */
    public function setCreatedAt(string $createdAt): self;
}
