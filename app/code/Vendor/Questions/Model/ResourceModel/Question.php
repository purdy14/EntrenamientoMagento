<?php
namespace Vendor\Questions\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Question extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('vendor_questions', 'question_id');
    }
}
