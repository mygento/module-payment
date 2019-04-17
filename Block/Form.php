<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Block;

class Form extends \Magento\Payment\Block\Form
{
    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /**
     * Instructions text
     * @var string
     */
    protected $instructions;

    /**
     * @var string
     */
    protected $_template = 'Mygento_Payment::form/form.phtml';

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
     * Returns applicable payment types
     *
     * @return array
     */
    public function getPayTypes()
    {
        return explode(',', $this->helper->getConfig('paytype'));
    }

    /**
     * @return string
     */
    public function getInstructions()
    {
        if ($this->instructions === null) {
            $this->instructions = $this->helper->getConfig('instructions');
        }

        return $this->instructions;
    }
}
