<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Gateway\Validator;

class Validator extends \Magento\Payment\Gateway\Validator\AbstractValidator
{
    /** @var \Mygento\Payment\Helper\Data */
    protected $helper;

    /**
     * @param ResultInterfaceFactory $resultFactory
     */
    public function __construct(
        \Mygento\Payment\Helper\Data $helper,
        \Magento\Payment\Gateway\Validator\ResultInterfaceFactory $resultFactory
    ) {
        parent::__construct($resultFactory);
        $this->_helper = $helper;
    }

    /**
     * @inheritdoc
     */
    public function validate(array $validationSubject)
    {
        $isValid = false;
        $errorMessages = [];
        return $this->createResult($isValid, $errorMessages);
    }
}
