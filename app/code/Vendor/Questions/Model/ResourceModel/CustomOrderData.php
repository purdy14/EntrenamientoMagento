<?php
namespace Vendor\Questions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomOrderData extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_order_data', 'entity_id');
    }
}
