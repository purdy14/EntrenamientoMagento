<?php
namespace Ntt\Questions\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            ['question' => 'What is Magento?', 'answer' => 'Magento is an open-source e-commerce platform.'],
            ['question' => 'How to install Magento?', 'answer' => 'You can install Magento via Composer or download the package.']
        ];
        
        $setup->getConnection()->insertMultiple($setup->getTable('ntt_questions'), $data);
    }
}
