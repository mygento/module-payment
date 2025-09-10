<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\ResourceModel\Keys;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mygento\Payment\Model\Keys;
use Mygento\Payment\Model\ResourceModel\Keys as KeysResource;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = KeysResource::TABLE_PRIMARY_KEY;

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(
            Keys::class,
            KeysResource::class,
        );
    }
}
