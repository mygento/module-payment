<?php

/**
 * @author Mygento Team
 * @copyright 2016-2026 Mygento (https://www.mygento.com)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model\ResourceModel\Registration;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mygento\Payment\Model\Registration;
use Mygento\Payment\Model\ResourceModel\Registration as RegistrationResource;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = RegistrationResource::TABLE_PRIMARY_KEY;

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(
            Registration::class,
            RegistrationResource::class,
        );
    }
}
