<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\Source;

class Steps implements \Magento\Framework\Option\ArrayInterface
{
    public const ONE_STEP = 1;
    public const TWO_STEP = 2;

    /**
     * One/Two factor payment
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::ONE_STEP, 'label' => __('One-step')],
            ['value' => self::TWO_STEP, 'label' => __('Two-step')],
        ];
    }
}
