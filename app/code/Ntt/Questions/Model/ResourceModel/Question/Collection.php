<?php
namespace Ntt\Questions\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Ntt\Questions\Model\Question', 'Ntt\Questions\Model\ResourceModel\Question');
    }
}
