<?php
namespace Vendor\Questions\Model;

use Magento\Framework\Model\AbstractModel;

class CustomOrderData extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vendor\Questions\Model\ResourceModel\CustomOrderData');
    }
}
