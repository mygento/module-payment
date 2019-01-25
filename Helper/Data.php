<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Helper;

/**
 * Payment Data helper
 */
class Data extends \Mygento\Base\Helper\Data
{
    /* @var string */
    protected $code = 'payment';

    /**
     * @var \Mygento\Payment\Model\KeyManager
     */
    private $keyManager;

    /**
     * @var \Mygento\Payment\Model\RegistrationManager
     */
    private $regManager;

    /**
     *
     * @param \Mygento\Payment\Model\KeyManager $keyManager
     * @param \Mygento\Payment\Model\RegistrationManager $regManager
     * @param \Mygento\Base\Model\LogManager $logManager
     * @param \Magento\Framework\Encryption\Encryptor $encryptor
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Mygento\Payment\Model\KeyManager $keyManager,
        \Mygento\Payment\Model\RegistrationManager $regManager,
        \Mygento\Base\Model\LogManager $logManager,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct(
            $logManager,
            $encryptor,
            $context
        );
        $this->keyManager = $keyManager;
        $this->regManager = $regManager;
    }

    public function isActive()
    {
        return $this->getPaymentConfig('active');
    }

    /**
     *
     * @param int|string $orderId
     * @return string
     */
    public function getLink($orderId): string
    {
        return $this->keyManager->getLink($this->code, $orderId);
    }

    /**
     * @param string $link
     * @return int|bool
     */
    public function decodeLink($link)
    {
        return $this->keyManager->decodeLink($this->code, $link);
    }

    /**
     * @param int|string $orderId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByOrderID($orderId)
    {
        return $this->regManager->getRegistrationByOrderID($this->code, $orderId);
    }

    /**
     * @param int|string $paymentId
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function getRegistrationByPaymentID($paymentId)
    {
        return $this->regManager->getRegistrationByPaymentID($this->code, $paymentId);
    }

    /**
     * @param int|string $orderId
     * @param int|string $paymentId
     * @param string $redirectUrl
     * @param int $try
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return \Mygento\Payment\Api\Data\RegistrationInterface
     */
    public function createRegistration($orderId, $paymentId, string $redirectUrl, $try = 1)
    {
        return $this->regManager->createRegistration($this->code, $orderId, $paymentId, $redirectUrl, $try);
    }

    /**
     * @param string $path
     * @param null $storeId
     * @return mixed
     */
    public function getPaymentConfig($path, $storeId = null)
    {
        $scope = $this->code === 'payment' ? 'mygento' : 'payment';
        return parent::getConfig(
            $scope . '/' . $this->code . '/' . $path,
            $storeId
        );
    }

    protected function getDebugConfigPath()
    {
        return 'debug';
    }
}
