<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\Method;

/**
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Adapter extends \Magento\Payment\Model\Method\Adapter
{
    /**
     * @var \Magento\Payment\Gateway\Command\CommandPoolInterface|null
     */
    protected $commandPool;

    /**
     * @var \Magento\Payment\Gateway\Data\PaymentDataObjectFactory
     */
    protected $paymentDataObjectFactory;

    /**
     * Adapter constructor.
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Payment\Gateway\Config\ValueHandlerPoolInterface $valueHandlerPool
     * @param \Magento\Payment\Gateway\Data\PaymentDataObjectFactory $paymentDataObjectFactory
     * @param string $code
     * @param string $formBlockType
     * @param string $infoBlockType
     * @param \Magento\Payment\Gateway\Command\CommandPoolInterface|null $commandPool
     * @param \Magento\Payment\Gateway\Validator\ValidatorPoolInterface|null $validatorPool
     * @param \Magento\Payment\Gateway\Command\CommandManagerInterface|null $commandExecutor
     * @param \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Payment\Gateway\Config\ValueHandlerPoolInterface $valueHandlerPool,
        \Magento\Payment\Gateway\Data\PaymentDataObjectFactory $paymentDataObjectFactory,
        $code,
        $formBlockType,
        $infoBlockType,
        \Magento\Payment\Gateway\Command\CommandPoolInterface $commandPool = null,
        \Magento\Payment\Gateway\Validator\ValidatorPoolInterface $validatorPool = null,
        \Magento\Payment\Gateway\Command\CommandManagerInterface $commandExecutor = null,
        \Psr\Log\LoggerInterface $logger = null
    ) {
        parent::__construct(
            $eventManager,
            $valueHandlerPool,
            $paymentDataObjectFactory,
            $code,
            $formBlockType,
            $infoBlockType,
            $commandPool,
            $validatorPool,
            $commandExecutor,
            $logger
        );

        $this->commandPool = $commandPool;
        $this->paymentDataObjectFactory = $paymentDataObjectFactory;
    }

    /**
     * @param string $commandCode
     * @param array $arguments
     */
    public function executeCustomCommand($commandCode, $arguments = [])
    {
        if ($this->commandPool === null) {
            return;
        }

        if (isset($arguments['payment'])
            && $arguments['payment'] instanceof \Magento\Payment\Model\InfoInterface
          ) {
            $arguments['payment'] = $this->paymentDataObjectFactory->create($arguments['payment']);
        }
        $command = $this->commandPool->get($commandCode);

        return $command->execute($arguments);
    }
}
