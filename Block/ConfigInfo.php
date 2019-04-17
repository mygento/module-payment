<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Block;

class ConfigInfo extends Info
{
    /**
     * @var \Magento\Payment\Gateway\ConfigInterface
     */
    protected $config;

    /**
     * @var \Mygento\Base\Helper\Discount
     */
    protected $taxHelper;

    /**
     * @param \Magento\Payment\Gateway\ConfigInterface $config
     * @param \Mygento\Payment\Helper\Data $helper
     * @param \Mygento\Base\Helper\Discount $taxHelper
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Payment\Gateway\ConfigInterface $config,
        \Mygento\Payment\Helper\Data $helper,
        \Mygento\Base\Helper\Discount $taxHelper,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($helper, $context, $data);
        $this->config = $config;
        $this->taxHelper = $taxHelper;
    }

    /**
     * @return \Magento\Payment\Gateway\ConfigInterface
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @return \Mygento\Base\Helper\Discount
     */
    protected function getTaxHelper()
    {
        return $this->taxHelper;
    }
}
