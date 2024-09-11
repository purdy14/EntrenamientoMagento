<?php
namespace Vendor\Questions\Model;

use Magento\Sales\Model\Order as BaseOrder;

class Order extends BaseOrder
{
    const CUSTOM_FIELD = 'custom_field';

    protected function _construct()
    {
        parent::_construct();
        $this->_init('Vendor\Questions\Model\ResourceModel\Order');
    }

    public function getCustomField()
    {
        return $this->getData(self::CUSTOM_FIELD);
    }

    public function setCustomField($value)
    {
        return $this->setData(self::CUSTOM_FIELD, $value);
    }
}
