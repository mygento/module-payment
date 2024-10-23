<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Helper;

/**
 * Transaction Payment helper
 */
class Transaction extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Mygento\Payment\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Sales\Api\TransactionRepositoryInterface
     */
    private $transactionRepo;

    /**
     * @var \Magento\Sales\Model\Order\Payment\Transaction\ManagerInterface
     */
    private $transactionManager;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @param \Mygento\Payment\Helper\Data $helper
     * @param \Magento\Sales\Model\Order\Payment\Transaction\ManagerInterface $transactionManager
     * @param \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepo
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Mygento\Payment\Helper\Data $helper,
        \Magento\Sales\Model\Order\Payment\Transaction\ManagerInterface $transactionManager,
        \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepo,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
        $this->helper = $helper;
        $this->transactionRepo = $transactionRepo;
        $this->transactionManager = $transactionManager;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param float $amount
     * @param array $transData
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedAuthorize($order, $transactionId, $amount, $transData = [])
    {
        $this->helper->debug('proceed authorize: ' . $transactionId . ' ' . $amount, $transData);
        $payment = $order->getPayment();
        $payment->setTransactionId($transactionId);
        $payment->setIsTransactionClosed(0);
        $payment->registerAuthorizationNotification($amount);
        $payment->setAmountAuthorized($amount);

        $this->orderRepository->save($order);

        if (!empty($transData)) {
            $transData = $this->prepareTransData($transData);
            $this->updateTransactionData(
                $transactionId,
                $payment->getId(),
                $order->getId(),
                $transData
            );
        }

        return $payment;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param float $amount
     * @param array $transData
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedCapture($order, $transactionId, $amount, $transData = [])
    {
        $this->helper->debug('proceed capture: ' . $transactionId . ' ' . $amount, $transData);
        $payment = $order->getPayment();
        $payment->setTransactionId($transactionId);
        $payment->setIsTransactionClosed(0);
        $payment->registerCaptureNotification($amount, true);
        $order->setIsInProcess(true);

        $this->orderRepository->save($order);

        if (!empty($transData)) {
            $transData = $this->prepareTransData($transData);
            $this->updateTransactionData(
                $transactionId,
                $payment->getId(),
                $order->getId(),
                $transData
            );
        }

        return $payment;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param string $parentTransactionId
     * @param float $amount
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedRefund($order, $transactionId, $parentTransactionId, $amount)
    {
        $this->helper->debug('proceed refund: ' . $transactionId .
            ' ' . $parentTransactionId . ' ' . $amount);
        $payment = $order->getPayment();

        $payment->setTransactionId($transactionId)
            ->setParentTransactionId($parentTransactionId)
            ->setIsTransactionClosed(true);
        $payment->registerRefundNotification($amount);

        $this->orderRepository->save($order);

        return $payment;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param string $parentTransactionId
     * @param float $amount
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedVoid($order, $transactionId, $parentTransactionId, $amount)
    {
        $this->helper->debug('proceed void: ' . $transactionId
          . ' ' . $parentTransactionId . ' ' . $amount);
        $payment = $order->getPayment();
        $payment->registerVoidNotification($amount);

        $this->orderRepository->save($order);

        return $payment;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param string $parentTransactionId
     * @param mixed $transData
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedReceipt($order, $transactionId, $parentTransactionId, $transData)
    {
        $this->helper->debug('proceed receipt: ' . $transactionId, $transData);

        if (
            $this->checkIfTransactionExists(
                $transactionId,
                $order->getPayment()->getId(),
                $order->getId()
            )
        ) {
            $this->helper->notice('transaction %1 already exists', $transactionId);

            return;
        }

        $invoice = $this->getInvoiceForTransactionId($order, $parentTransactionId);

        $payment = $order->getPayment();
        $payment->setTransactionId($transactionId)
            ->setParentTransactionId($parentTransactionId)
            ->setIsTransactionClosed(true);
        $transaction = $payment->addTransaction(
            \Mygento\Base\Model\Payment\Transaction::TYPE_FISCAL,
            $invoice ? $invoice : $order
        );
        $transaction->setAdditionalInformation(
            \Magento\Sales\Model\Order\Payment\Transaction::RAW_DETAILS,
            $transData
        );
        $transaction->save();
        $order->addStatusHistoryComment(
            __('Got Fiscal Receipt for transaction %1', $parentTransactionId),
            false
        );

        $this->orderRepository->save($order);

        return $payment;
    }

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @param string $parentTransactionId
     * @param mixed $transData
     *
     * @return \Magento\Sales\Api\Data\OrderPaymentInterface
     */
    public function proceedRefundReceipt($order, $transactionId, $parentTransactionId, $transData)
    {
        $this->helper->debug('Proceed receipt refund: ' . $transactionId, $transData);

        if (
            $this->checkIfTransactionExists(
                $transactionId,
                $order->getPayment()->getId(),
                $order->getId()
            )
        ) {
            $this->helper->notice('Transaction %1 already exists', $transactionId);

            return;
        }

        $memo = $this->getCreditMemoForTransactionId($order, $parentTransactionId);

        $payment = $order->getPayment();
        $payment->setTransactionId($transactionId)
            ->setParentTransactionId($parentTransactionId)
            ->setIsTransactionClosed(true);
        $transaction = $payment->addTransaction(
            \Mygento\Base\Model\Payment\Transaction::TYPE_FISCAL_REFUND,
            $memo ? $memo : $order
        );
        $transaction->setAdditionalInformation(
            \Magento\Sales\Model\Order\Payment\Transaction::RAW_DETAILS,
            $transData
        );
        $transaction->save();
        $order->addStatusHistoryComment(
            __('Got Fiscal Refund Receipt for transaction %1', $parentTransactionId),
            false
        );

        $this->orderRepository->save($order);

        return $payment;
    }

    /**
     * @param string $transactionId
     * @param int $paymentId
     * @param int $orderId
     * @param mixed $transData
     */
    protected function updateTransactionData($transactionId, $paymentId, $orderId, $transData)
    {
        $this->helper->debug('seaching for transaction: ' . $transactionId
            . ' ' . $paymentId . ' ' . $orderId);
        $transaction = $this->transactionRepo->getByTransactionId(
            $transactionId,
            $paymentId,
            $orderId
        );

        if (!$transaction) {
            $this->helper->notice('not found payment transaction');

            return;
        }
        $this->helper->debug('found transaction with id: ' . $transaction->getId());
        $transaction->setAdditionalInformation(
            \Magento\Sales\Model\Order\Payment\Transaction::RAW_DETAILS,
            $transData
        );
        $transaction->save();
    }

    /**
     * Return invoice model for transaction
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @return false|\Magento\Sales\Model\Order\Invoice
     */
    protected function getInvoiceForTransactionId($order, $transactionId)
    {
        foreach ($order->getInvoiceCollection() as $invoice) {
            if ($invoice->getTransactionId() == $transactionId) {
                $invoice->load($invoice->getId());

                return $invoice;
            }
        }

        return false;
    }

    /**
     * Return invoice model for transaction
     *
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string $transactionId
     * @return false|\Magento\Sales\Model\Order\Creditmemo
     */
    protected function getCreditMemoForTransactionId($order, $transactionId)
    {
        foreach ($order->getCreditmemosCollection() as $creditmemo) {
            if ($creditmemo->getTransactionId() == $transactionId) {
                $creditmemo->load($creditmemo->getId());

                return $creditmemo;
            }
        }

        return false;
    }

    /**
     * Checks if transaction exists by txt id
     *
     * @param string $transactionId
     * @param int $paymentId
     * @param int $orderId
     * @return bool
     */
    protected function checkIfTransactionExists($transactionId, $paymentId, $orderId)
    {
        return $this->transactionManager->isTransactionExists(
            $transactionId,
            $paymentId,
            $orderId
        );
    }

    /**
     * @param mixed $transData
     * @return mixed
     */
    private function prepareTransData($transData)
    {
        if (!is_array($transData)) {
            return $transData;
        }

        return array_map(
            function ($item) {
                if (!is_array($item)) {
                    return $item;
                }

                return json_encode($item);
            },
            $transData
        );
    }
}
