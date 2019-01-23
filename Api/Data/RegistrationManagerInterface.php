<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface RegistrationManagerInterface
{
    /**
     * @param string $code
     * @param int|string $orderId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByOrderID(string $code, $orderId);

    /**
     * @param string $code
     * @param int|string $paymentId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByPaymentID(string $code, $paymentId);

    /**
     * @param string $code
     * @param int|string $orderId
     * @param int|string $paymentId
     * @param string $redirectUrl
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function createRegistration(string $code, $orderId, $paymentId, string $redirectUrl);
}
