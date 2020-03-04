<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Block;

use Magento\Sales\Model\Order;

class Info extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'Mygento_Payment::form/info.phtml';

    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /**
     * @param \Mygento\Payment\Helper\Data $helper
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Mygento\Payment\Helper\Data $helper,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * @return \Magento\Sales\Api\Data\OrderInterface
     */
    public function getOrder()
    {
        return $this->getInfo()->getOrder();
    }

    /**
     * @return string
     */
    public function getPaylink()
    {
        return $this->helper->getLink($this->getOrder()->getId());
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->helper->getCode();
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        $order = $this->getOrder();

        return $order->hasInvoices() && !$order->hasCreditmemos();
    }

    /**
     * @return bool
     */
    public function isComplete()
    {
        $state = $this->getOrder()->getState();
        if ($this->getOrder()->isCanceled() ||
            $state === Order::STATE_COMPLETE ||
            $state === Order::STATE_CLOSED
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function canShowPayLink()
    {
        if ($this->isPaid() || $this->isAuthorized()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isAuthorized()
    {
        $payment = $this->getOrder()->getPayment();

        return $payment->getAuthorizationTransaction() &&
            (bool) $payment->getAmountAuthorized() &&
            !(bool) $payment->getAmountPaid() &&
            !(int) $payment->getAuthorizationTransaction()->getIsClosed();
    }

    /**
     * @return string
     */
    public function getCheckUrl()
    {
        return '';
    }
}
