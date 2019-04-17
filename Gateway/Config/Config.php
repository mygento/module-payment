<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Gateway\Config;

class Config extends \Magento\Payment\Gateway\Config\Config
{
    /** @var \Magento\Framework\Encryption\Encryptor */
    protected $encryptor;

    /**
     * @param \Magento\Framework\Encryption\Encryptor $encryptor
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param mixed $methodCode
     * @param mixed $pathPattern
     */
    public function __construct(
        \Magento\Framework\Encryption\Encryptor $encryptor,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        $methodCode = null,
        $pathPattern = \Magento\Payment\Gateway\Config\Config::DEFAULT_PATH_PATTERN
    ) {
        parent::__construct($scopeConfig, $methodCode, $pathPattern);
        $this->encryptor = $encryptor;
    }
}
