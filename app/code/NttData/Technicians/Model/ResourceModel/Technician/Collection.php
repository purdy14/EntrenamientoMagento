<?php

namespace NttData\Technicians\Model\ResourceModel\Technician;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('NttData\Technicians\Model\Technician', 'NttData\Technicians\Model\ResourceModel\Technician');
    }
}
