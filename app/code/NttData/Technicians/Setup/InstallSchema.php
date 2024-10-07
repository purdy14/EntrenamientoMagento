<?php
/**
 * NttData_Technicians Module
 *
 * @category    NttData
 * @package     NttData_Technicians
 */

namespace NttData\Technicians\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(
        SchemaSetupInterface   $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();

        /*
         * Create table 'nttdata_technicians'
         */

        $table = $installer->getConnection()->newTable(
            $installer->getTable('nttdata_technicians')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Technician Id'
        )->addColumn(
            'sku',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'SKU'
        )->addColumn(
            'nombre_tecnico',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Technician Name'
        )->addColumn(
            'celular_tecnico',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Technician Cellphone'
        )->addColumn(
            'correo_tecnico',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Technician Email'
        )->addColumn(
            'codigo_tecnico',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Technician Code'
        )->addColumn(
            'dia_semana',
            Table::TYPE_TEXT,
            3,
            ['nullable' => false],
            'Day of the Week (Mon, Tue, etc.)'
        )->addColumn(
            'regional',
            Table::TYPE_TEXT,
            50,
            ['nullable' => false],
            'Regional Office'
        )->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false, 'default' => '1'],
            'Status'
        )->addColumn(
            'created_at',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Creation Time'
        )->addColumn(
            'updated_at',
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false, 'on update' => true],
            'Update Time'
        )->setComment(
            'NttData Technicians Table'
        );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
