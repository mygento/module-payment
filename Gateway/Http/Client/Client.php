<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Gateway\Http\Client;

class Client implements \Magento\Payment\Gateway\Http\ClientInterface
{
    /** @var \Magento\Payment\Gateway\ConfigInterface */
    protected $config;

    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /** @var \Magento\Framework\HTTP\Client\Curl */
    protected $curl;

    public function __construct(
        \Magento\Payment\Gateway\ConfigInterface $config,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Mygento\Payment\Helper\Data $helper
    ) {
        $this->curl = $curl;
        $this->config = $config;
        $this->helper = $helper;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function placeRequest(\Magento\Payment\Gateway\Http\TransferInterface $transferObject)
    {
        return null;
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @param mixed $path
     * @return string
     */
    protected function sendRequest($path, array $params = [])
    {
        $this->curl->post($this->url . $path, $params);
        return $this->curl->getBody();
    }
}
