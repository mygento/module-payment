<?php

namespace Mygento\Payment\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'mygento_payment_keys'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mygento_payment_keys')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Key ID'
        )->addColumn(
            'code',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Module CodeName'
        )->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Order ID'
        )->addColumn(
            'hkey',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Hashed Key'
        )->addForeignKey(
            $installer->getFkName('mygento_payment_keys', 'order_id', 'sales_order', 'entity_id'),
            'order_id',
            $installer->getTable('sales_order'),
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment(
            'mygento_payment_keys Table'
        );
        $installer->getConnection()->createTable($table);


        /**
         * Create table 'mygento_payment_registration'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mygento_payment_registration')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Key ID'
        )->addColumn(
            'code',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Module CodeName'
        )->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true],
            'Order ID'
        )->addColumn(
            'payment_id',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Payment ID'
        )->addColumn(
            'payment_url',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Payment Url'
        )->addColumn(
            'try',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => false, 'unsigned' => true, 'default' => 0],
            'Try'
        )->addColumn(
            'payment_type',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Payment Type'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Created At'
        )->addForeignKey(
            $installer->getFkName('mygento_payment_registration', 'order_id', 'sales_order', 'entity_id'),
            'order_id',
            $installer->getTable('sales_order'),
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment(
            'mygento_payment_registration Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
