<?php
namespace Vendor\Questions\Model\ResourceModel;

use Magento\Sales\Model\ResourceModel\Order as BaseOrder;

class Order extends BaseOrder
{
    protected function _construct()
    {
        $this->_init('sales_order', 'entity_id');
        
    }
}
