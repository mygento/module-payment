<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Controller\Payment;

abstract class AbstractAction extends \Magento\Framework\App\Action\Action
{
    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /**
     * @var \Mygento\Payment\Helper\Transaction
     */
    protected $transHelper;

    /** @var \Magento\Sales\Model\OrderFactory */
    protected $orderFactory;

    /** @var \Magento\Checkout\Model\Session */
    protected $checkoutSession;

    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;

    public function __construct(
        \Mygento\Payment\Helper\Data $helper,
        \Mygento\Payment\Helper\Transaction $transHelper,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->helper = $helper;
        $this->transHelper = $transHelper;
        $this->orderFactory = $orderFactory;
        $this->checkoutSession = $checkoutSession;
        $this->resultLayoutFactory = $resultLayoutFactory;
    }
}
