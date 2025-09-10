<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface KeysInterface
{
    public const ID = 'id';
    public const CODE = 'code';
    public const ORDER_ID = 'order_id';
    public const HKEY = 'hkey';

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
     * Get hkey
     */
    public function getHkey(): string;

    /**
     * Set hkey
     */
    public function setHkey(string $hkey): self;
}
