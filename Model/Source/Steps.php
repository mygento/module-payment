<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\Source;

class Steps implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * One/Two factor payment
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('One-step')],
            ['value' => 2, 'label' => __('Two-step')]
        ];
    }
}
