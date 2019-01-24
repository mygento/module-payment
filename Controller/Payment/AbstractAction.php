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

    public function __construct(
        ActionContext $actionContext
    ) {
        parent::__construct($actionContext->context);

        $this->helper = $actionContext->helper;
        $this->transHelper = $actionContext->transHelper;
        $this->orderFactory = $actionContext->orderFactory;
        $this->checkoutSession = $actionContext->checkoutSession;
        $this->resultForwardFactory = $actionContext->resultForwardFactory;
    }
}
