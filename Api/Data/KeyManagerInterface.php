<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Api\Data;

interface KeyManagerInterface
{
    /**
     * @param string $code
     * @param int|string $orderId
     * @return string
     */
    public function getLink(string $code, $orderId): string;

    /**
     * @param string $code
     * @param string $link
     * @return bool|int
     */
    public function decodeLink(string $code, string $link);

    /**
     * @param int|string $orderId
     * @return string
     */
    public function genHash($orderId): string;
}
