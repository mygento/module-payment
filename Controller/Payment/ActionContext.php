<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Controller\Payment;

class ActionContext
{
    /**
     * @var \Mygento\Payment\Helper\Data
     */
    public $helper;

    /**
     * @var \Mygento\Payment\Helper\Transaction
     */
    public $transHelper;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    public $orderFactory;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    public $checkoutSession;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    public $resultForwardFactory;

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    public $context;

    public function __construct(
        \Mygento\Payment\Helper\Data $helper,
        \Mygento\Payment\Helper\Transaction $transHelper,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        $this->helper = $helper;
        $this->transHelper = $transHelper;
        $this->orderFactory = $orderFactory;
        $this->checkoutSession = $checkoutSession;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->context = $context;
    }
}
