<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Controller\Payment;

abstract class AbstractAction extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Mygento\Payment\Helper\Data
     */
    protected $helper;

    /**
     * @var \Mygento\Payment\Helper\Transaction
     */
    protected $transHelper;

    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @param \Mygento\Payment\Controller\Payment\ActionContext $context
     */
    public function __construct(
        \Mygento\Payment\Controller\Payment\ActionContext $context
    ) {
        parent::__construct($context->context);

        $this->helper = $context->helper;
        $this->transHelper = $context->transHelper;
        $this->orderFactory = $context->orderFactory;
        $this->checkoutSession = $context->checkoutSession;
        $this->resultForwardFactory = $context->resultForwardFactory;
    }
}
