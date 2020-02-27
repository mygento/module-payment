<?php

/**
 * @author Mygento Team
 * @copyright 2016-2020 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\ResourceModel\Keys;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /** @var string */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Mygento\Payment\Model\Keys::class,
            \Mygento\Payment\Model\ResourceModel\Keys::class
        );
    }
}
