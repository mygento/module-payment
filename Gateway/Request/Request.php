<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Gateway\Request;

class Request implements \Magento\Payment\Gateway\Request\BuilderInterface
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
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function build(array $buildSubject)
    {
        return [];
    }
}
