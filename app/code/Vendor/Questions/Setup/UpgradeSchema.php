<?php

namespace Vendor\Module\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Solo agregar el nuevo campo si la versión actual es menor a 1.1.0
        if (version_compare($context->getVersion(), '1.1.0', '<')) {
            // Modifica la tabla 'questions' para agregar un nuevo campo de texto
            $setup->getConnection()->addColumn(
                $setup->getTable('Vendor_Questions'), // nombre de la tabla
                'new_test_field', // nombre del nuevo campo
                [
                    'type' => Table::TYPE_TEXT, // Tipo de dato (TEXT)
                    'nullable' => true,        // Permitir nulos
                    'default' => null,         // Valor por defecto es nulo
                    'comment' => 'New Text Field' // Comentario del campo
                ]
            );
        }

        $setup->endSetup();
    }
}
