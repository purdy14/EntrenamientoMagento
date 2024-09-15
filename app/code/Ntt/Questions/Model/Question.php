<?php
namespace Ntt\Questions\Model;

use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Ntt\Questions\Model\ResourceModel\Question');
    }
}
