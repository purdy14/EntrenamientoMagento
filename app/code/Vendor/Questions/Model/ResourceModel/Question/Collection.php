<?php
namespace Vendor\Questions\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vendor\Questions\Model\Question', 'Vendor\Questions\Model\ResourceModel\Question');
    }
}
