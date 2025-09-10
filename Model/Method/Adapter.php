<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\Method;

use Magento\Framework\Event\ManagerInterface;
use Magento\Payment\Gateway\Command\CommandManagerInterface;
use Magento\Payment\Gateway\Command\CommandPoolInterface;
use Magento\Payment\Gateway\Config\ValueHandlerPoolInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectFactory;
use Magento\Payment\Gateway\Validator\ValidatorPoolInterface;
use Psr\Log\LoggerInterface;

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

    public function __construct(
        ManagerInterface $eventManager,
        ValueHandlerPoolInterface $valueHandlerPool,
        PaymentDataObjectFactory $paymentDataObjectFactory,
        $code,
        $formBlockType,
        $infoBlockType,
        ?CommandPoolInterface $commandPool = null,
        ?ValidatorPoolInterface $validatorPool = null,
        ?CommandManagerInterface $commandExecutor = null,
        ?LoggerInterface $logger = null,
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
            $logger,
        );

        $this->commandPool = $commandPool;
        $this->paymentDataObjectFactory = $paymentDataObjectFactory;
    }

    public function executeCustomCommand(string $commandCode, array $arguments = [])
    {
        if ($this->commandPool === null) {
            return;
        }

        if (
            isset($arguments['payment'])
            && $arguments['payment'] instanceof \Magento\Payment\Model\InfoInterface
        ) {
            $arguments['payment'] = $this->paymentDataObjectFactory->create($arguments['payment']);
        }
        $command = $this->commandPool->get($commandCode);

        return $command->execute($arguments);
    }
}
