<?php
namespace Vendor\Questions\Model;

use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Vendor\Questions\Model\ResourceModel\Question');
    }
}
