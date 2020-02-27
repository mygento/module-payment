<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Gateway\Response;

class Response implements \Magento\Payment\Gateway\Response\HandlerInterface
{
    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /**
     * @param \Mygento\Payment\Helper\Data $helper
     */
    public function __construct(
        \Mygento\Payment\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Handles transaction id
     *
     * @param array $handlingSubject
     * @param array $response
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @return void
     */
    public function handle(array $handlingSubject, array $response)
    {
        return null;
    }
}
